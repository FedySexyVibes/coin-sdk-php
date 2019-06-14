<?php

use PHPUnit\Framework\TestCase;
use common\crypto\CtpApiClientUtil;

class CtpApiClientUtilTest extends TestCase
{
    public function testCtpUtils() {
        echo CtpApiClientUtil::hmacSecretFromEncryptedFile("../../../sharedkey.encrypted", "../../../private-key.pem");
    }

}
