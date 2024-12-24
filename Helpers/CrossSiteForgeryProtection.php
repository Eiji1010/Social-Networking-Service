<?php

namespace Helpers;

class CrossSiteForgeryProtection
{
    public static function getToken()
    {
        return $_SESSION['csrf_token'];
    }
}