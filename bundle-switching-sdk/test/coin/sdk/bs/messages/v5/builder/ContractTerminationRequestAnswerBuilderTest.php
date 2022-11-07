<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\bs\messages\v5\builder;

use coin\sdk\bs\ObjectSerializer;

class ContractTerminationRequestAnswerBuilderTest extends SendMessageBaseTest
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = ContractTerminationRequestAnswerBuilder::create();

        $builder
            ->setHeader("TEST01", "TEST02", "TEST01", "TEST02")
            ->setDossierId("TEST01-TEST02-12345-01")
            ->setBlocking("Y")
            ->setBlockingcode("7");

        $contractTerminationRequestAnswer = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $contractTerminationRequestAnswer->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"contractterminationrequestanswer"', $contractTerminationRequestAnswer->__toString(), "Message should contain a body with a pradelayed declaration");

        $response = $this->service->sendMessage($contractTerminationRequestAnswer);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\bs\messages\v5\MessageResponse');
        $this->assertNotNull($messageResponse->getTransactionId(), "A transactionId should be received");
    }
}
