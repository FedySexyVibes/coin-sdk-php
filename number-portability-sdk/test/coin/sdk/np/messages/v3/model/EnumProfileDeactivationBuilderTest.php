<?php /** @noinspection PhpParamsInspection */

namespace coin\sdk\np\messages\v3\model;

use coin\sdk\np\messages\v3\builder\EnumProfileDeactivationBuilder;
use coin\sdk\np\messages\v3\ObjectSerializer;

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
        $messageResponse = ObjectSerializer::deserialize($object, 'coin\sdk\np\messages\v3\model\MessageResponse');
        $this->assertNotNull($messageResponse->getTransactionId(), "A transactionId should be received");
    }
}
