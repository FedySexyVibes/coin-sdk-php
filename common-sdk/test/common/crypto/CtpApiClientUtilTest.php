<?php

use PHPUnit\Framework\TestCase;
use common\crypto\CtpApiClientUtil;

class CtpApiClientUtilTest extends TestCase
{
    public function testCtpUtils() {
        $privateKey = CtpApiClientUtil::readPrivateKeyFile("../../../private-key.pem");
        echo CtpApiClientUtil::hmacSecretFromEncryptedFile("../../../sharedkey.encrypted", $privateKey);
        TestCase::assertTrue(true);
    }
}
