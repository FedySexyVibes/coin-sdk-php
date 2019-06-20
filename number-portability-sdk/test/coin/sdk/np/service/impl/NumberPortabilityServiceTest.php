<?php

use PHPUnit\Framework\TestCase;

class NumberPortabilityServiceTest extends TestCase
{
    public function testMessageCanBeSend()
    {
        $consumerName = "loadtest-loada";
        $privateKeyFile = "../../../../../private-key.pem";
        $encryptedHmacSecretFile = "../../../../../sharedkey.encrypted";

        $service = new NumberPortabilityService($consumerName, $privateKeyFile, $encryptedHmacSecretFile);
        $service->postMessage('{"message":{"header":{"receiver":{"networkoperator":"LOADB","serviceprovider":"LOADB"},"sender":{"networkoperator":"LOADA","serviceprovider":"LOADA"},"timestamp":"20190619093853"},"body":{"cancel":{"dossierid":"123456","note":"Just a note!"}}}}', "cancel");
    }
}
