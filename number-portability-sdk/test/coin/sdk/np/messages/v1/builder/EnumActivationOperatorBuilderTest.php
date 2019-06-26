<?php

namespace coin\sdk\np\messages\v1\builder;

use PHPUnit\Framework\TestCase;

class EnumActivationOperatorBuilderTest extends TestCase
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = EnumActivationOperatorBuilder::create();

        $builder
            ->setFullHeader("TEST01", "TEST01", "TEST02", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setTypeOfNumber("Mobile")
            ->setCurrentNetworkOperator("TEST01")
            ->addEnumOperatorSequence()
                ->setProfileId("profile")
                ->setDefaultService("N")
                ->finish();

        $enumactivationoperator = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $enumactivationoperator->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"enumactivationoperator"', $enumactivationoperator->__toString(), "Message should contain a body with a pradelayed declaration");
    }
}
