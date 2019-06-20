<?php

use coin\sdk\np\service\impl\INumberPortabilityMessageListener;
use coin\sdk\np\service\impl\NumberPortabilityMessageConsumer;
use PHPUnit\Framework\TestCase;

class NumberPortabilityMessageConsumerTest extends TestCase
{
    public function test()
    {
        $baseUrl = "http://kong:8000/number-portability/v1";
        $consumerName = "loadtest-loada";
        $privateKeyFile = "keys/private-key.pem";
        $encryptedHmacSecretFile = "keys/sharedkey.encrypted";

        $consumer = new NumberPortabilityMessageConsumer($consumerName, $privateKeyFile, $encryptedHmacSecretFile, $baseUrl);
        $listener = new TestListener();
        $messages = $consumer->getMessages($listener);
        $messages->next();
    }
}

class TestListener implements INumberPortabilityMessageListener
{

    function onMessage($messageId, $message)
    {
        echo $message;
    }
}
