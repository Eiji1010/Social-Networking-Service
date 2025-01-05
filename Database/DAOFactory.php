<?php

namespace Database;

use Database\DataAccess\FollowerPostDAO;
use Database\DataAccess\MessageDAO;
use Database\DataAccess\PostDAO;
use Database\DataAccess\UserDAO;
use Database\Implementations\FollowerPostDAOImpl;
use Database\Implementations\MessageDAOImpl;
use Database\Implementations\PostDAOImpl;
use Database\Implementations\UserDAOImpl;

class DAOFactory
{
    public static function getUserDAO(): UserDAO
    {
        return new UserDAOImpl();
    }

    public static function getMessageDAO(): MessageDAO
    {
        return new MessageDAOImpl();
    }

    public static function getPostDAO(): PostDAO
    {
        return new PostDAOImpl();
    }

    public static function getFollowerPostDAO(): FollowerPostDAO
    {
        return new FollowerPostDAOImpl();
    }
}
