<?php

namespace Database\Implementations;

use Database\DataAccess\UserDAO;
use Database\MySQLWrapper;
use Models\DateTimeStamp;
use Models\User;

class UserDAOImpl implements UserDAO
{
    public function create(User $user, string $password): bool
    {
        if ($user->getId() !== null) throw new \Exception('Cannot create a user that already has an ID: ' . $user->getId());

        $mysqli = new MySQLWrapper();
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

        $result = $mysqli->prepareAndExecute(
            $query,
            'sss',
            [
                $user->getUsername(),
                $user->getEmail(),
                password_hash($password, PASSWORD_DEFAULT)
            ]
        );

        if (!$result) return false;

        $user->setId($mysqli->insert_id);
        return true;
    }

    private function getRawById(int $id): ?array
    {
        $mysqli = new MySQLWrapper();
        $query = "SELECT * FROM users WHERE id = ?";
        return $mysqli->prepareAndFetchAll($query, 'i', [$id])[0] ?? null;
    }

    private function getRawByEmail(string $email): ?array
    {
        $mysqli = new MySQLWrapper();
        $query = "SELECT * FROM users WHERE email = ?";
        return $mysqli->prepareAndFetchAll($query, 's', [$email])[0] ?? null;
    }

    private function rawDataToUser(array $rawData): User
    {
        return new User(
            username: $rawData['username'],
            email: $rawData['email'],
            id: $rawData['id'],
            timeStamp: new DateTimeStamp($rawData['created_at'], $rawData['updated_at']),
            place: $rawData['place'],
            age: $rawData['age'],
            handle: $rawData['handle'],
            biography: $rawData['biography']
        );
    }

    public function getById(int $id): ?User
    {
        $userRaw = $this->getRawById($id);
        if ($userRaw === null) return null;
        return $this->rawDataToUser($userRaw);
    }

    public function getByEmail(string $email): ?User
    {
        $userRaw = $this->getRawByEmail($email);
        if ($userRaw === null) return null;
        return $this->rawDataToUser($userRaw);
    }

    public function getHashedPasswordById(int $id): ?string
    {
        return $this->getRawById($id)['password'] ?? null;
    }

    public function updateProfile(array $data): bool
    {
        $mysqli = new MySQLWrapper();
        $query = "UPDATE users SET username = ?, handle = ?, age = ?, place = ?, biography = ? WHERE id = ?";
        return $mysqli->prepareAndExecute(
            $query,
            'ssisss',
            [
                $data['username'] ?? '',
                $data['handle'] ?? '',
                $data['age'] ?? null,
                $data['place'] ?? '',
                $data['bio'] ?? '',
                $data['id'] ??  null
            ]
        );
    }

    public function getAll(): array
    {
        $mysqli = new MySQLWrapper();
        $query = "SELECT * FROM users";
        $rawData = $mysqli->query($query);
        $users = [];
        foreach ($rawData as $rawUser) {
            $users[] = $this->rawDataToUser($rawUser);
        }
        return $users;
    }

    public function getPosts(int $userId, ?int $offset, ?int $count): ?array
    {
        $mysqli = new MySQLWrapper();
        $query = "
            SELECT 
                posts.id AS post_id,
                posts.content AS post_content,
                posts.mediaUrl AS post_media,
                posts.postDate AS post_date,
                COUNT(DISTINCT comments.id) AS comment_count,
                COUNT(DISTINCT likes.id) AS like_count
            FROM 
                posts
            LEFT JOIN 
                comments ON posts.id = comments.postId
            LEFT JOIN 
                likes ON posts.id = likes.postId
            WHERE 
                posts.userId = ?
            GROUP BY 
                posts.id, posts.content, posts.mediaUrl, posts.postDate
            ORDER BY 
                posts.postDate DESC";

        $params = [$userId];
        $types = 'i';
        if ($offset!== null && $count!== null) {
            $query .= " LIMIT ?, ?";
            $params = array_merge($params, [(int)$offset, (int)$count]);
            $types .= 'ii';
        }
        $rawData = $mysqli->prepareAndFetchAll($query, $types, $params);
        return $rawData;
    }
}