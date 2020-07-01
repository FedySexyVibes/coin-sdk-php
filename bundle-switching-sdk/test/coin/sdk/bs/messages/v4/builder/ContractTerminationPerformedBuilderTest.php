<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\bs\messages\v4\builder;

use coin\sdk\bs\ObjectSerializer;

class ContractTerminationPerformedBuilderTest extends SendMessageBaseTest
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = ContractTerminationPerformedBuilder::create();

        $builder
            ->setHeader("TEST01", "TEST02", "TEST01", "TEST02")
            ->setDossierId("TEST01-TEST02-12345-01")
            ->setActualDateTime(date( 'Y-m-d\TH:i:s', time()));

        $contractTerminationPerformed = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $contractTerminationPerformed->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"contractterminationperformed"', $contractTerminationPerformed->__toString(), "Message should contain a body with a pradelayed declaration");

        $response = $this->service->sendMessage($contractTerminationPerformed);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\bs\messages\v4\MessageResponse');
        $this->assertNotNull($messageResponse->getTransactionId(), "A transactionId should be received");
    }
}
