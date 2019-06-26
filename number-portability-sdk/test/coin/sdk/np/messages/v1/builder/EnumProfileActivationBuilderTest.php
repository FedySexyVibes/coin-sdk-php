<?php

namespace coin\sdk\np\messages\v1\builder;

use PHPUnit\Framework\TestCase;

class EnumProfileActivationBuilderTest extends TestCase
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = EnumProfileActivationBuilder::create();

        $builder
            ->setFullHeader("TEST01", "TEST01", "TEST02", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setCurrentNetworkOperator("TEST01")
            ->setProfileId("PROF1")
            ->setTypeOfNumber("mobile");

        $enumprofileactivation = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $enumprofileactivation->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"enumprofileactivation"', $enumprofileactivation->__toString(), "Message should contain a body with a pradelayed declaration");
    }
}
