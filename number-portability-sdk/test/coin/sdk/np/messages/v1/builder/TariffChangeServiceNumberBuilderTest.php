<?php

namespace coin\sdk\np\messages\v1\builder;

use PHPUnit\Framework\TestCase;

class TariffChangeServiceNumberBuilderTest extends TestCase
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');

        $builder = TariffChangeServiceNumberBuilder::create();
        $builder
            ->setFullHeader("LOADA", "LOADA", "LOADB", "LOADB")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("123456")
            ->setPlatformProvider("TEST01")
            ->setPlannedDateTime(date("Ymdhis", time()))
            ->addActivationServiceNumberSequence()
                ->setNumberSeries("0123456789", "0987654321")
                ->setPop("pop")
                ->setTariffinfo("2023,50", "1023,50", "0", "2", "1")
                ->finish();

        $tariffchangesn = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $tariffchangesn->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"tariffchangesn"', $tariffchangesn->__toString(), "Message should contain a body with a cancel declaration");
    }
}
