<?php

namespace coin\sdk\np\messages\v1\builder;

use PHPUnit\Framework\TestCase;

class EnumActivationRangeBuilderTest extends TestCase
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = EnumActivationRangeBuilder::create();

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

        $enumactivationrange = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $enumactivationrange->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"enumactivationrange"', $enumactivationrange->__toString(), "Message should contain a body with a pradelayed declaration");
    }
}
