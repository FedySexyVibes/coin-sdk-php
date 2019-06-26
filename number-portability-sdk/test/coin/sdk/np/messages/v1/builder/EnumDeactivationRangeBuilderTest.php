<?php

namespace coin\sdk\np\messages\v1\builder;

use PHPUnit\Framework\TestCase;

class EnumDeactivationRangeBuilderTest extends TestCase
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = EnumDeactivationRangeBuilder::create();

        $builder
            ->setFullHeader("TEST01", "TEST01", "TEST02", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setTypeOfNumber("Mobile")
            ->setCurrentNetworkOperator("TEST01")
            ->addEnumNumberSequence()
                ->setNumberSeries("01234567890", "0987654321")
                ->setProfileIds(["PROF1", "PROF2"])
                ->finish();

        $enumdeactivationrange = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $enumdeactivationrange->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"enumdeactivationrange"', $enumdeactivationrange->__toString(), "Message should contain a body with a pradelayed declaration");
    }
}
