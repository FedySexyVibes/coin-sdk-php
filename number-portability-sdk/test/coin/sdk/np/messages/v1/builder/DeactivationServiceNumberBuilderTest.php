<?php

namespace coin\sdk\np\messages\v1\builder;

use PHPUnit\Framework\TestCase;

class DeactivationServiceNumberBuilderTest extends TestCase
{
    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = DeactivationServiceNumberBuilder::create();

        $builder
            ->setFullHeader("TEST01", "TEST01", "TEST02", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setPlannedDateTime(date("Ymdhis", time()))
            ->setPlatformProvider("TEST01");

        $activationServiceNumber = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $activationServiceNumber->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"deactivationsn"', $activationServiceNumber->__toString(), "Message should contain a body with a pradelayed declaration");
    }

}
