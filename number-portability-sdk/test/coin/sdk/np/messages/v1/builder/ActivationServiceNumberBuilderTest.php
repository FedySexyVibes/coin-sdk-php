<?php

namespace coin\sdk\np\messages\v1\builder;

use NumberPortabilityService;
use PHPUnit\Framework\TestCase;

class ActivationServiceNumberBuilderTest extends TestCase
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = ActivationServiceNumberBuilder::create();

        $builder
            ->setFullHeader("TEST01", "TEST01", "TEST02", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setPlannedDateTime(date("Ymdhis", time()))
            ->setNote("TEST02")
            ->setPlatformProvider("TEST02")
            ->addActivationServiceNumberSequence()
                ->setNumberseries("0123456789", "0987654321")
                ->setTariffinfo("2023,50", "1023,50", "0", "2", "1")
                ->setPop("pop")
                ->finish();

        $activationServiceNumber = $builder->build();

        $this->assertStringStartsWith("{\"message\"", $activationServiceNumber->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"activationsn"', $activationServiceNumber->__toString(), "Message should contain a body with a pradelayed declaration");
    }
}