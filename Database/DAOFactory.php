<?php

namespace Database;

use Database\DataAccess\UserDAO;
use Database\Implementations\UserDAOImpl;

class DAOFactory
{
    public static function getUserDAO(): UserDAO
    {
        return new UserDAOImpl();
    }
}
