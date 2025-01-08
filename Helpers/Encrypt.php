<?php

namespace Helpers;

use Cassandra\Set;

class Encrypt
{
    private const METHOD='AES-256-CBC';

    public static function encrypt(string $data): string
    {
        $key = Settings::env('ENCRYPTION_KEY');
        $iv_length = openssl_cipher_iv_length(self::METHOD);
        $iv = openssl_random_pseudo_bytes($iv_length);

        $encrypted = openssl_encrypt($data, self::METHOD, $key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv.$encrypted);
    }

    public static function decrypt(string $input): string
    {
        $key = Settings::env('ENCRYPTION_KEY');
        $decode = base64_decode($input);
        $iv_length = openssl_cipher_iv_length(self::METHOD);
        $iv = substr($decode, 0, $iv_length);
        $encrypted = substr($decode, $iv_length);

        $decrypted = openssl_decrypt($encrypted, self::METHOD, $key, OPENSSL_RAW_DATA, $iv);

        if ($decrypted === false){
            throw new \Exception('Could not decrypt the data');
        }
        return $decrypted;
    }
}