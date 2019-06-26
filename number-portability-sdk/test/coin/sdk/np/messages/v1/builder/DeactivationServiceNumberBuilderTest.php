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
            ->setPlatformProvider("TEST02")
            ->addDeactivationServiceNumberSequence()
                ->setNumberseries("0123456789", "0987654321")
                ->setPop("pop")
                ->finish();

        $deactivationServiceNumber = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $deactivationServiceNumber->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"deactivationsn"', $deactivationServiceNumber->__toString(), "Message should contain a body with a pradelayed declaration");
    }
}
