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

    public function prepareAndExecute(string $query, string $string, array $data): bool
    {
        $this->typesAndDataValidationPass($string, $data);

        $stmt = $this->prepare($query);
        if (count($data) > 0) $stmt->bind_param($string, ...$data);
        return $stmt->execute();
    }

    public function prepareAndFetchAll(string $query, string $string, array $array): ?array
    {
        $this->typesAndDataValidationPass($string, $array);

        $stmt = $this->prepare($query);
        if (count($array) > 0) $stmt->bind_param($string, ...$array);
        $stmt->execute();

        $result = $stmt->get_result();
        if($result === false) throw new \Exception(sprintf("Error fetching data on query %s", $query));
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    private function typesAndDataValidationPass(string $types, array $data): void
    {
        if(strlen($types) !== count($data)){
            throw new \Exception(sprintf("Type and data must equal in length %s vs %s", strlen($types), count($data)));
        }
    }
}