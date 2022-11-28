<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v3\model;

use coin\sdk\np\messages\v3\builder\EnumDeactivationOperatorBuilder;
use coin\sdk\np\messages\v3\ObjectSerializer;

class EnumDeactivationOperatorBuilderTest extends SendMessageBaseTest
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = EnumDeactivationOperatorBuilder::create();

        $builder
            ->setHeader("TEST01", "TEST02", "TEST01", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setTypeOfNumber("3")
            ->setCurrentNetworkOperator("TEST01")
            ->addEnumOperatorSequence()
                ->setProfileId("PROF-1234")
                ->setDefaultService("Y")
                ->finish();

        $enumdeactivationoperator = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $enumdeactivationoperator->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"enumdeactivationoperator"', $enumdeactivationoperator->__toString(), "Message should contain a body with a pradelayed declaration");

        $response = $this->service->sendMessage($enumdeactivationoperator);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v3\model\MessageResponse');
        $this->assertNotNull($messageResponse->getTransactionId(), "A transactionId should be received");
    }
}
