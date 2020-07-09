<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v1\builder;

use coin\sdk\np\ObjectSerializer;

class EnumProfileDeactivationBuilderTest extends SendMessageBaseTest
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = EnumProfileDeactivationBuilder::create();

        $builder
            ->setHeader("TEST01", "TEST02", "TEST01", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setCurrentNetworkOperator("TEST01")
            ->setProfileId("PROF1")
            ->setTypeOfNumber("3");

        $enumprofiledeactivation = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $enumprofiledeactivation->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"enumprofiledeactivation"', $enumprofiledeactivation->__toString(), "Message should contain a body with a pradelayed declaration");

        $response = $this->service->sendMessage($enumprofiledeactivation);
        $object = json_decode($response->getBody());
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v1\MessageResponse');
        $this->assertRegExp('/[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}/i', $messageResponse->getTransactionId(), "A transactionId with the correct pattern should be received");
    }
}
