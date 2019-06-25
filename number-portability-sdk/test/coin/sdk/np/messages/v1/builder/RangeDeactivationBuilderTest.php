<?php

namespace coin\sdk\np\messages\v1\builder;

use PHPUnit\Framework\TestCase;

class RangeDeactivationBuilderTest extends TestCase
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');

        $builder = RangeDeactivationBuilder::create();
        $builder
            ->setFullHeader("LOADA", "LOADA", "LOADB", "LOADB")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("123456")
            ->setPlannedDateTime(date("Ymdhis", time()))
            ->setCurrentNetworkOperator("TEST01")
            ->setOptaNr("01")
            ->addDeactivationServiceNumberSequence()
                ->setNumberSeries("0123456789", "0987654321")
                ->setPop("pop")
                ->finish();

        $rangedeactivation = $builder->build();

        echo($rangedeactivation);

        $this->assertStringStartsWith("{\"message\"", $rangedeactivation->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"rangedeactivation"', $rangedeactivation->__toString(), "Message should contain a body with a cancel declaration");
    }
}
