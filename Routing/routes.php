<?php
namespace Routing;

use Database\DAOFactory;
use Exception;
use Helpers\Authenticate;
use Helpers\ValidationHelper;
use Models\User;
use Response\FlashData;
use Response\Render\HTMLRenderer;
use Response\Render\RedirectRenderer;
use Types\ValueType;

return [
    'login' => Route::create('login', function() {
        return new HTMLRenderer('page/login', []);
    }),

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

    }),

    'logout' => Route::create('logout', function() {
        Authenticate::logoutUser();
        return new RedirectRenderer('login');
    }),

    'register' => Route::create('register', function() {
        return new HTMLRenderer('page/register', []);
    }),

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
    }),

    'homepage' => Route::create('homepage', function(){
        return new HTMLRenderer('page/homepage', []);
    }),

    'profile' => Route::create('profile', function(){
        return new HTMLRenderer('page/profile', []);
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
    })
];