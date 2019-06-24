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
            "x-date" => date(\DateTime::RFC1123),
            "digest" => "SHA-256=$hash"
        );
    }

    public static function CalculateHttpRequestHmac($hmacSecret, $consumerName, array $hmacHeaders, $requestLine) {
        $headerKeys = array_keys($hmacHeaders);
        $message = implode("\n", array_map(function($key, $val) {return "$key: $val";}, $headerKeys, $hmacHeaders))."\n".$requestLine;
        $hasher = new Hash('sha256');
        $hasher->setKey($hmacSecret);
        $signature = utf8_decode(base64_encode($hasher->hash($message)));
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
