<?php

namespace coin\sdk\np\messages\v1\builder;

use PHPUnit\Framework\TestCase;

class RangeActivationBuilderTest extends TestCase
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');

        $builder = RangeActivationBuilder::create();
        $builder
            ->setFullHeader("LOADA", "LOADA", "LOADB", "LOADB")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("123456")
            ->setPlannedDateTime(date("Ymdhis", time()))
            ->setCurrentNetworkOperator("TEST01")
            ->setOptaNr("01")
            ->addActivationServiceNumberSequence()
                ->setNumberSeries("0123456789", "0987654321")
                ->setPop("pop")
                ->setTariffinfo("2023,50", "1023,50", "0", "2", "1")
                ->finish();

        $rangeactivation = $builder->build();

        echo($rangeactivation);

        $this->assertStringStartsWith("{\"message\"", $rangeactivation->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"rangeactivation"', $rangeactivation->__toString(), "Message should contain a body with a cancel declaration");
    }
}
