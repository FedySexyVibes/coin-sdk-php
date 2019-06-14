<?php

namespace common\crypto;

require_once __DIR__.'/../../../vendor/autoload.php';

use phpseclib\Crypt\RSA;

class CtpApiClientUtil
{
    public static function HmacFromEncryptedBase64EncodedSecretFile($filename, $privateKey) {
        $content = file_get_contents($filename);
        $encryptedHmac =  mb_convert_encoding($content, 'UTF-8',
	          mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
        $rsa = new RSA();
        $rsa->setPrivateKeyFormat(RSA::PRIVATE_FORMAT_PKCS1);
        $rsa->setPrivateKey($privateKey);
        return $rsa->decrypt($encryptedHmac);
    }
}
