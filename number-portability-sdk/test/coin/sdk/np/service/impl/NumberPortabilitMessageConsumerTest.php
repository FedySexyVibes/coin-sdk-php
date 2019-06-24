<?php

use coin\sdk\np\service\impl\INumberPortabilityMessageListener;
use coin\sdk\np\service\impl\NumberPortabilityMessageConsumer;
use PHPUnit\Framework\TestCase;

class NumberPortabilityMessageConsumerTest extends TestCase
{
    public function test()
    {
        $consumer = new NumberPortabilityMessageConsumer();
        $listener = new TestListener();
        $messages = $consumer->getMessages($listener);
        sleep(1);
        $messages->next();
    }
}

class TestListener implements INumberPortabilityMessageListener
{

    function onMessage($messageId, $message)
    {
        echo "\nTestListener received the following message:\n$message\n";
    }
}
