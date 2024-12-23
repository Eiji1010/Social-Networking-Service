<?php

namespace Helpers;

use Database\DAOFactory;
use Models\User;

class Authenticate
{
    private static ?User $authenticatedUser = null;
    private const USER_ID_SESSION = 'user_id';

    public static function loginAsUser(?User $authenticatedUser): bool
    {
        if ($authenticatedUser->getId() === null) throw new \Exception('Cannot login a user with no ID.');
        if (isset($_SESSION[self::USER_ID_SESSION])) throw new \Exception('User is already logged in. Logout before continuing.');

        $_SESSION[self::USER_ID_SESSION] = $authenticatedUser->getId();
        return true;
    }
    public static function authenticate(string $email, string $password): User
    {
        $userDao = DAOFactory::getUserDAO();
        self::$authenticatedUser = $userDao->getByEmail($email);

        if (self::$authenticatedUser === null) throw new \Exception('User not found.');

        $hashedPassword = $userDao->getHashedPasswordById(self::$authenticatedUser->getId());

        if (password_verify($password, $hashedPassword)) {
            self::loginAsUser(self::$authenticatedUser);
            return self::$authenticatedUser;
        } else {
            throw new \Exception('Invalid password.');
        }
    }

    public static function logoutUser(): bool
    {
        if (isset($_SESSION[self::USER_ID_SESSION])){
            unset($_SESSION[self::USER_ID_SESSION]);
            self::$authenticatedUser = null;
            return true;
        } else {
            throw new \Exception('No user to logout.');
        }
    }

    public static function getAuthenticatedUser(): ?User
    {
        self::retrieveAuthenticatedUser();
        return self::$authenticatedUser;
    }

    private static function retrieveAuthenticatedUser(): void
    {
        if (!isset($_SESSION[self::USER_ID_SESSION])) return;
        $userDao = DAOFactory::getUserDAO();
        self::$authenticatedUser = $userDao->getById($_SESSION[self::USER_ID_SESSION]);
    }
}