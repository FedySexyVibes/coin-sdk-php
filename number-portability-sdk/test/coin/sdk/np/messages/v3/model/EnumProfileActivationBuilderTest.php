<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v3\model;

use coin\sdk\np\messages\v3\builder\EnumProfileActivationBuilder;
use coin\sdk\np\messages\v3\ObjectSerializer;

class EnumProfileActivationBuilderTest extends SendMessageBaseTest
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = EnumProfileActivationBuilder::create();

        $builder
            ->setHeader("TEST01", "TEST02", "TEST01", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setCurrentNetworkOperator("TEST01")
            ->setProfileId("PROF1-12345")
            ->setTypeOfNumber("3")
            ->setReplacement("Test")
            ->setService("Test")
            ->setPreference("13")
            ->setOrder("13")
            ->setScope("SCOPE-123")
            ->setGateway("Test")
            ->setFlags("Test")
            ->setDnsClass("Test")
            ->setTtl("7")
            ->setRecType("Test");

        $enumprofileactivation = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $enumprofileactivation->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"enumprofileactivation"', $enumprofileactivation->__toString(), "Message should contain a body with a pradelayed declaration");

        $response = $this->service->sendMessage($enumprofileactivation);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v3\model\MessageResponse');
        $this->assertMatchesRegularExpression('/[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}/i', $messageResponse->getTransactionId(), "A transactionId with the correct pattern should be received");
    }
}
