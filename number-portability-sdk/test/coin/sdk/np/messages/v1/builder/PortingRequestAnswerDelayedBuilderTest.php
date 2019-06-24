<?php

namespace coin\sdk\np\messages\v1\builder;

use PHPUnit\Framework\TestCase;

class PortingRequestAnswerDelayedBuilderTest extends TestCase
{

    public function testBuildPortingRequestAnswerDelayedMessage()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = PortingRequestAnswerDelayedBuilder::create();

        $builder
            ->setFullHeader("TEST01", "TEST01", "TEST02", "TEST02")
            ->setDossierId("TEST01-12345")
            ->setAnswerDueDateTime(date("Ymdhis", time()))
            ->setDonorNetworkOperator("TEST02")
            ->setDonorServiceProvider("TEST02")
            ->setReasonCode("99");

        $portingRequestAnswerDelayed = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $portingRequestAnswerDelayed->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"pradelayed"', $portingRequestAnswerDelayed->__toString(), "Message should contain a body with a pradelayed declaration");
    }
}
