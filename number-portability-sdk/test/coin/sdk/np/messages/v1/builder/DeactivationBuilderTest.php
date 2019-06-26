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
            ->setOriginalNetworkOperator("TEST01")
            ->addDeactivationSequence()
                ->setNumberSeries("0123456789", "0987654321")
                ->finish();

        $deactivation = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $deactivation->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"deactivation"', $deactivation->__toString(), "Message should contain a body with a pradelayed declaration");
    }
}
