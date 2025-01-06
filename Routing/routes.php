<?php
namespace Routing;

use Database\DAOFactory;
use Exception;
use Helpers\Authenticate;
use Helpers\ValidationHelper;
use Models\Message;
use Models\Post;
use Models\User;
use Response\FlashData;
use Response\Render\HTMLRenderer;
use Response\Render\JsonRenderer;
use Response\Render\RedirectRenderer;
use Types\ValueType;

return [
    'login' => Route::create('login', function() {
        return new HTMLRenderer('page/login', []);
    })->setMiddleware(['guest']),

    'form/login' => Route::create('/form/login', function() {
        try{
            if (!$_SERVER["REQUEST_METHOD"] === 'POST') throw new Exception('Invalid request method: ' . $_SERVER["REQUEST_METHOD"]);

            $required_fields = [
                'email' => ValueType::EMAIL,
                'password' => ValueType::PASSWORD
            ];

            $validatedData = ValidationHelper::validateFields($required_fields, $_POST);
            Authenticate::authenticate($validatedData['email'], $validatedData['password']);
            FlashData::setFlashData('success', 'Successfully logged in.');
            return new RedirectRenderer('homepage');
        }
        catch (Exception $e){
            FlashData::setFlashData('error', 'Invalid email or password.');
            return new RedirectRenderer('login');
        }
    })->setMiddleware(['guest']),

    'logout' => Route::create('logout', function() {
        Authenticate::logoutUser();
        return new RedirectRenderer('login');
    }),

    'register' => Route::create('register', function() {
        return new HTMLRenderer('page/register', []);
    })->setMiddleware(['guest']),

    'form/register' => Route::create('/form/register', function (){
        try{
            if (!$_SERVER["REQUEST_METHOD"] === 'POST') throw new Exception('Invalid request method: ' . $_SERVER["REQUEST_METHOD"]);

            $required_fields = [
                'username' => ValueType::STRING,
                'email' => ValueType::EMAIL,
                'password' => ValueType::PASSWORD,
                'confirm-password' => ValueType::PASSWORD
            ];

            $validatedData = ValidationHelper::validateFields($required_fields, $_POST);

            $username = $validatedData['username'];
            $email = $validatedData['email'];
            $password = $validatedData['password'];
            $passwordConfirmation = $validatedData['confirm-password'];

            if($password !== $passwordConfirmation) throw new Exception('Password and password confirmation do not match.');

            $userDao = DAOFactory::getUserDAO();
            $user = new User(username: $username, email: $email);

            $success = $userDao->create($user, $password);
            if(!$success) throw new Exception('Failed to create user.');

            Authenticate::loginAsUser($user);
            FlashData::setFlashData('success', 'Successfully registered and logged in.');
            return new RedirectRenderer('login');
        }
        catch (Exception $e){
            FlashData::setFlashData('error', $e->getMessage());
            return new RedirectRenderer('register');
        }
    })->setMiddleware(['guest']),

    'homepage' => Route::create('homepage', function(){
        $messageDao = DAOFactory::getMessageDAO();
        $message = $messageDao->getBySenderId(Authenticate::getAuthenticatedUser()->getId(), 1, 10);
        return new HTMLRenderer('page/homepage', ['message' => $message]);
    })->setMiddleware(['auth']),

    'profile' => Route::create('profile', function(){
        return new HTMLRenderer('page/profile', []);
    })->setMiddleware(['auth']),

    "api/profile" => Route::create('api/profile?page=${page}', function() {
        try {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 20; // 1ページあたりの件数
            $offset = ($page - 1) * $limit;

            $userDAO = DAOFactory::getUserDAO();
            $userId = Authenticate::getAuthenticatedUser()->getId();

            $posts = $userDAO->getPosts($userId, $offset, $limit);

            $postDAO = DAOFactory::getPostDAO();
            $totalMessages = $postDAO->countByUserId($userId);
            $extractedContents= array_map(function($message) {
                return [
                    'username' => Authenticate::getAuthenticatedUser()->getUsername(),
                    'content' => $message['post_content'],
                    'commentCount' => $message['comment_count'],
                    'likeCount' => $message['like_count']
                ];
            }, $posts);

            return new JsonRenderer([
                'message' => $extractedContents,
                'hasMore' => ($offset + $limit) < $totalMessages
            ]);
        }
        catch (Exception $e) {
            return new JsonRenderer(['error' => $e->getMessage()], 500);
        }
    }),

    'form/edit-profile' => Route::create('/form/edit-profile', function() {
        try{
            if (!$_SERVER["REQUEST_METHOD"] === "POST") throw new Exception('Invalid request method: ' . $_SERVER["REQUEST_METHOD"]);

            $user = Authenticate::getAuthenticatedUser();

            $required_fields = [
                'username' => ValueType::STRING,
                'handle' => ValueType::STRING,
                'age' => ValueType::INT,
                'place' => ValueType::STRING,
                'biography' => ValueType::STRING
            ];

            $validatedData = ValidationHelper::validateFields($required_fields, $_POST);

            $username = $validatedData['username'];
            $handle = $validatedData['handle'];
            $age = $validatedData['age'];
            $place = $validatedData['place'];
            $bio = $validatedData['biography'];

            $data = [
                'username' => $username,
                'handle' => $handle,
                'age' => $age,
                'place' => $place,
                'bio' => $bio,
                'id' => $user->getId(),
            ];

            error_log('Data: ' . json_encode($data));

            $userDao = DAOFactory::getUserDAO();
            $success = $userDao->updateProfile($data);
            if(!$success) throw new Exception('Failed to update profile.');

            return new RedirectRenderer('homepage');
        }
        catch (Exception $e){
            FlashData::setFlashData('error', $e->getMessage());
            return new RedirectRenderer('profile');
        }
    })->setMiddleware(['auth']),

    "form/post" => Route::create("/form/post", function(){
        $content = $_POST['post'];
        $post = new Post(userId: Authenticate::getAuthenticatedUser()->getId(), content: $content);
        $postDao = DAOFactory::getPostDAO();
        $postDao->create($post);
        $post = $postDao->getByUserId(Authenticate::getAuthenticatedUser()->getId());
        return new RedirectRenderer('homepage', ['post' => $post]);
    })->setMiddleware(['auth']),

    'user' => Route::create('/user?username=${username}', function(){
        $username = $_GET['username'];

        return new HTMLRenderer('page/profile', []);
    })->setMiddleware(['auth']),

    "api/posts" => Route::create('/api/posts', function () {
        try {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 20; // 1ページあたりの件数
            $offset = ($page - 1) * $limit;

            if ($_GET['tab'] === 'trending') {
                $postDAO = DAOFactory::getPostDAO();
                $userId = 2;

                $messages = $postDAO->getByUserId($userId, $offset, $limit);
                $totalMessages = $postDAO->countByUserId($userId);
                return new JsonRenderer([
                    'message' => array_map(fn($message) => $message->getContent(), $messages),
                    'hasMore' => ($offset + $limit) < $totalMessages
                ]);
            } elseif ($_GET['tab'] === 'following') {
                $followerPostDao = DAOFactory::getFollowerPostDAO();
                $userId = Authenticate::getAuthenticatedUser()->getId();

                $messages = $followerPostDao->getFollowerPosts($userId, $offset, $limit);
                $totalMessages = $followerPostDao->getFollowerPostsCount($userId);

                $extractedMessages = array_map(function($message) {
                    return [
                        'id' => $message['post_id'],
                        'username' => $message['poster_username'],
                        'content' => $message['post_content'],
                        'commentCount' => $message['comment_count'],
                        'likeCount' => $message['like_count']
                    ];
                }, $messages);

                return new JsonRenderer([
                    'message' => $extractedMessages,
                    'hasMore' => ($offset + $limit) < $totalMessages
                ]);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid tab specified.']);
            }
        } catch (Exception $e) {
            return new JsonRenderer(['error' => $e->getMessage()], 500);
        }
    }),
];