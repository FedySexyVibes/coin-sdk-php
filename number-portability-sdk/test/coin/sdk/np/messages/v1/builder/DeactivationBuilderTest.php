<?php

namespace coin\sdk\np\messages\v1\builder;

use PHPUnit\Framework\TestCase;

class DeactivationBuilderTest extends TestCase
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = DeactivationBuilder::create();

        $builder
            ->setFullHeader("TEST01", "TEST01", "TEST02", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setCurrentNetworkOperator("TEST02")
            ->setOriginalNetworkOperator("TEST01");

        $activationServiceNumber = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $activationServiceNumber->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"deactivation"', $activationServiceNumber->__toString(), "Message should contain a body with a pradelayed declaration");
    }
}
