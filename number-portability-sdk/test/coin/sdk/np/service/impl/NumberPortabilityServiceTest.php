<?php

use PHPUnit\Framework\TestCase;

class NumberPortabilityServiceTest extends TestCase
{
    public function testMessageCanBeSend()
    {
        $service = new NumberPortabilityService();
        $service->postMessage('{"message":{"header":{"receiver":{"networkoperator":"LOADB","serviceprovider":"LOADB"},"sender":{"networkoperator":"LOADA","serviceprovider":"LOADA"},"timestamp":"20190619093853"},"body":{"cancel":{"dossierid":"123456","note":"Just a note!"}}}}', "cancel");
    }
}
