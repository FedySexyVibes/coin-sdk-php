<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v1\builder;

use coin\sdk\np\ObjectSerializer;

class EnumActivationOperatorBuilderTest extends SendMessageBaseTest
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = EnumActivationOperatorBuilder::create();

        $builder
            ->setFullHeader("TEST01", "TEST01", "TEST02", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setTypeOfNumber("Mobile")
            ->setCurrentNetworkOperator("TEST01")
            ->addEnumOperatorSequence()
                ->setProfileId("PROF-1234")
                ->setDefaultService("Y")
                ->finish();

        $enumactivationoperator = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $enumactivationoperator->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"enumactivationoperator"', $enumactivationoperator->__toString(), "Message should contain a body with a pradelayed declaration");

        $response = $this->service->sendMessage($enumactivationoperator);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v1\MessageResponse');
        $this->assertRegExp('/[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}/i', $messageResponse->getTransactionId(), "A transactionId with the correct pattern should be received");
    }
}
