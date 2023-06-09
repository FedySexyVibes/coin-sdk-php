<?php

namespace coin\sdk\common\crypto;

use Firebase\JWT\JWT;
use phpseclib\Crypt\Hash;
use phpseclib\Crypt\RSA;

class ApiClientUtil
{
    public static function readPrivateKeyFile($fileName) {
        $privateKey = file_get_contents($fileName);
        $rsa = new RSA();
        $rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);
        $rsa->loadKey($privateKey);
        return $rsa;
    }

    public static function hmacSecretFromEncryptedFile($hmacFile, RSA $privateKey) {
        $encryptedHmac = file_get_contents($hmacFile);
        return $privateKey->decrypt(base64_decode($encryptedHmac));
    }

    public static function getHmacHeaders($body) {
        $hash = base64_encode((new Hash('sha256'))->hash($body ?: ''));
        return array(
            "x-date" => gmdate('D, d M Y H:i:s').' GMT',
            "digest" => "SHA-256=$hash"
        );
    }

    public static function CalculateHttpRequestHmac($hmacSecret, $consumerName, array $hmacHeaders, $requestLine) {
        $headerKeys = array_keys($hmacHeaders);
        $message = implode("\n", array_map(function($key, $val) {return "$key: $val";}, $headerKeys, $hmacHeaders))."\n".$requestLine;
        $signature = mb_convert_encoding(base64_encode(hash_hmac('sha256', $message, $hmacSecret, true)), 'ISO-8859-1', 'UTF-8');
        $joinedHeaders = implode(" ", $headerKeys);
        return "hmac username=\"$consumerName\", algorithm=\"hmac-sha256\", headers=\"$joinedHeaders request-line\", signature=\"$signature\"";
    }

    public static function createJwt(RSA $privateKey, $consumerName, $validPeriodInSeconds) {
        $token = array(
            "iss" => "$consumerName",
            "nbf" => round(microtime(true)) - 30,
            "exp" => round(microtime(true)) + 30 + $validPeriodInSeconds
        );
        return JWT::encode($token, $privateKey, "RS256");
    }
}
