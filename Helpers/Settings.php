<?php
namespace Helpers;

class Settings{
    private const ENV_PATH = ".env";

    public static function env(string $pair): string{
        $config = parse_ini_file(dirname(__FILE__, 2) . '/' . self::ENV_PATH);
        if($config === false){
            throw new \Exception("Error reading .env file");
        }
        return $config[$pair];
    }
}