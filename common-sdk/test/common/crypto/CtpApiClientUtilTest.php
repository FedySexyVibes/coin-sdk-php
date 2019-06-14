<?php

use PHPUnit\Framework\TestCase;
use common\crypto\CtpApiClientUtil;

class CtpApiClientUtilTest extends TestCase
{
    public function testCtpUtils() {
        CtpApiClientUtil::HmacFromEncryptedBase64EncodedSecretFile();
    }

}
