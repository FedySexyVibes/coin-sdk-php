<?php

namespace coin\sdk\np\messages\v1\builder;

use PHPUnit\Framework\TestCase;

class PortingPerformedBuilderTest extends TestCase
{

    public function testBuild()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $builder = PortingPerformedBuilder::create();

        $builder
            ->setFullHeader("TEST01", "TEST01", "TEST02", "TEST02")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("TEST01-12345")
            ->setDonorNetworkOperator("TEST01")
            ->setRecipientNetworkOperator("TEST02")
            ->setBatchporting("N")
            ->setActualDateTime(date("Ymdhis", time()))
            ->addPortingPerformedSequence()
                ->setNumberSeries("0123456789", "0987654321")
                ->setPop("pop")
                ->setBackPorting("N")
                ->setProfileIds(["PROF1", "PROF2"])
                ->finish();

        $portingPerformed = $builder->build();

        echo($portingPerformed);

        $this->assertStringStartsWith("{\"message\"", $portingPerformed->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"portingperformed"', $portingPerformed->__toString(), "Message should contain a body with a pradelayed declaration");
    }
}
