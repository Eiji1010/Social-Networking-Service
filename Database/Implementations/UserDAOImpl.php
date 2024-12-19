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
            timeStamp: new DateTimeStamp($rawData['created_at'], $rawData['updated_at'])
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
}