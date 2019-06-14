<?php

namespace common\crypto;

use phpseclib\Crypt\RSA;

class CtpApiClientUtil
{
    /*public static function readUtf8File($filename) {
    $content = file_get_contents($filename);
    return mb_convert_encoding($content, 'UTF-8',
        mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
    }*/

    public static function readPrivateKeyFile($fileName) {
        $privateKey = file_get_contents($fileName);
        $rsa = new RSA();
        $rsa->setPrivateKeyFormat(RSA::PRIVATE_FORMAT_PKCS1);
        $rsa->setPrivateKey($privateKey);
        return $rsa;
    }

    public static function hmacSecretFromEncryptedFile($hmacFile, $privateKeyFile) {
        $privateKey = CtpApiClientUtil::readPrivateKeyFile($privateKeyFile);
        $encryptedHmac = file_get_contents($hmacFile);
        echo $encryptedHmac;
        return $privateKey->decrypt($encryptedHmac);
    }
}
