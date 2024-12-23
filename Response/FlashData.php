<?php
namespace Response;

class FlashData {
    public static function setFlashData(string $name, $data): void {
        $_SESSION['flash'][$name] = $data;
    }

    public static function getFlashData(string $name): mixed {
        if (isset($_SESSION['flash'][$name])){
            $message = $_SESSION['flash'][$name];
            error_log("message: $message");
            unset($_SESSION['flash'][$name]);
            return $message;
        }
        return null;
    }
}