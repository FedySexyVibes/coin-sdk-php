<?php

use PHPUnit\Framework\TestCase;

class NumberPortabilityServiceTest extends TestCase
{
    public function testMessageCanBeSend()
    {
        $baseUrl = "http://kong:8000/number-portability/v1";
        $consumerName = "loadtest-loada";
        $privateKeyFile = "keys/private-key.pem";
        $encryptedHmacSecretFile = "keys/sharedkey.encrypted";

        $service = new NumberPortabilityService($baseUrl, $consumerName, $privateKeyFile, $encryptedHmacSecretFile);
        $service->sendMessage('{"message":{"header":{"receiver":{"networkoperator":"LOADB","serviceprovider":"LOADB"},"sender":{"networkoperator":"LOADA","serviceprovider":"LOADA"},"timestamp":"20190619093853"},"body":{"cancel":{"dossierid":"123456","note":"Just a note!"}}}}', "cancel");
    }
}
