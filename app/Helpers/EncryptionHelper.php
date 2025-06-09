<?php

namespace App\Helpers;

class EncryptionHelper{
    public static function encPassword($pass, $userid)
    {
        $configVars = [
            'usePasswordHash' => false,
            'passwordHashAlgo' => 'sha256',
            'passwordHashOptions' => [],
            'hash' => 'sha256',
        ];

        $userid = strval($userid);

        if ($configVars['usePasswordHash']) {
            return hash($configVars['passwordHashAlgo'], $pass);
        } else {
            $salt = hash('md5', $userid);
            return hash($configVars['hash'], $salt . $pass);
        }
    }

    public static function checkPassword($pass, $userid, $hash)
    {
        return self::encPassword($pass, $userid) === $hash;
    }

    public static function generateKeyFromBase64($base64String)
    {
        return substr(hash('sha256', base64_decode($base64String)), 0, 32);
    }

    public static function encToken($text)
    {
        $key = self::generateKeyFromBase64("wokwiksecret");
        $iv = openssl_random_pseudo_bytes(16);
        $encrypted = openssl_encrypt($text, 'aes-256-cbc', $key, 0, $iv);

        return [
            'encryptedData' => $encrypted,
            'iv' => base64_encode($iv),
        ];
    }

    public static function decToken($encryptedData, $ivBase64)
    {
        $key = self::generateKeyFromBase64("wokwiksecret");
        $iv = base64_decode($ivBase64);
        $decrypted = openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $iv);

        return $decrypted;
    }
}
