<?php

namespace coin\sdk\np\messages\v1\builder;

use PHPUnit\Framework\TestCase;

class EnumDeactivationOperatorBuilderTest extends TestCase
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = EnumDeactivationOperatorBuilder::create();

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

        $enumdeactivationoperator = $builder->build();

        echo($enumdeactivationoperator);

        $this->assertStringStartsWith("{\"message\"", $enumdeactivationoperator->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"enumdeactivationoperator"', $enumdeactivationoperator->__toString(), "Message should contain a body with a pradelayed declaration");
    }
}
