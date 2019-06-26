<?php

namespace coin\sdk\np\messages\v1\builder;

use PHPUnit\Framework\TestCase;

class PortingRequestAnswerBuilderTest extends TestCase
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = PortingRequestAnswerBuilder::create();

        $builder
            ->setFullHeader("TEST01", "TEST01", "TEST02", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setBlocking("Y")
            ->addPortingRequestAnswerSequence()
                ->setNumberSeries("0123456789", "0987654321")
                ->setNote("Note")
                ->setDonorServiceProvider("TEST02")
                ->setDonorNetworkOperator("TEST02")
                ->setBlockingCode("99")
                ->setFirstPossibleDate(date("Ymdhis", time()))
                ->finish();

        $portingRequestAnswer = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $portingRequestAnswer->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"portingrequestanswer"', $portingRequestAnswer->__toString(), "Message should contain a body with a pradelayed declaration");
    }

}
