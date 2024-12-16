<?php

namespace Database;

use Helpers\Settings;
use mysqli;

class MySQLWrapper extends mysqli
{
    public function __construct(?string $hostname = 'localhost', ?string $username = null, ?string $password = null, ?string $database = null, ?int $port = null, ?string $socket = null)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $database = $database?? Settings::env('DATABASE_NAME');
        $username = $username?? Settings::env('DATABASE_USER');
        $password = $password?? Settings::env('DATABASE_USER_PASSWORD');

        parent::__construct($hostname, $username, $password, $database, $port, $socket);
    }
}