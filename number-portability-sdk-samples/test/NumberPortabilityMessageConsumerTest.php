<?php

use coin\sdk\np\service\impl\INumberPortabilityMessageListener;
use coin\sdk\np\service\impl\NumberPortabilityMessageConsumer;
use PHPUnit\Framework\TestCase;

class NumberPortabilityMessageConsumerSample extends TestCase
{
    public function testConsumeMessages()
    {
        $consumer = new NumberPortabilityMessageConsumer();
        $listener = new SampleListener();
        $messages = $consumer->getMessages($listener);
        foreach(range(1,20) as $i) {
            echo "\n".$messages->current();
            $messages->next();
            sleep(1);
        }
    }
}

class SampleListener implements INumberPortabilityMessageListener
{

    function onMessage($messageId, $message)
    {
        echo "\nTestListener received a message with id $messageId";
    }
}
