<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v3\model;

use coin\sdk\np\messages\v3\builder\EnumActivationOperatorBuilder;
use coin\sdk\np\messages\v3\ObjectSerializer;

class EnumActivationOperatorBuilderTest extends SendMessageBaseTest
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = EnumActivationOperatorBuilder::create();

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

        $enumactivationoperator = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $enumactivationoperator->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"enumactivationoperator"', $enumactivationoperator->__toString(), "Message should contain a body with a pradelayed declaration");

        $response = $this->service->sendMessage($enumactivationoperator);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v3\model\MessageResponse');
        $this->assertMatchesRegularExpression('/[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}/i', $messageResponse->getTransactionId(), "A transactionId with the correct pattern should be received");
    }
}
