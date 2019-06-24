<?php

use coin\sdk\np\messages\v1\builder\PortingRequestBuilder;
use coin\sdk\np\messages\v1\EnumProfileSeq;
use coin\sdk\np\messages\v1\EnumRepeats;
use coin\sdk\np\messages\v1\NumberSeries;
use coin\sdk\np\messages\v1\PortingRequestSeq;
use PHPUnit\Framework\TestCase;

class PortingRequestBuilderTest extends TestCase
{
    public function testPortingRequestMessageCanBeCreated()
    {
        date_default_timezone_set('Europe/Amsterdam');

        $builder = PortingRequestBuilder::create();
        $builder
            ->setFullHeader("LOADA", "LOADA", "LOADB", "LOADB")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("123456")
            ->setNote("Just a note!")
            ->setCustomerInfo("Test", "Vereniging COIN", "10", "a", "1111AA", "123456")
            ->addPortingRequestSeq(new PortingRequestSeq([
                'numberseries' => new NumberSeries([
                    'start' => '0223456789',
                    'end' => '0987654322'
                ]),
                'repeats' => array(new EnumRepeats([
                    'seq' => new EnumProfileSeq([
                        'profileid' => 'PROF1'
                    ])

                ]), new EnumRepeats([
                    'seq' => new EnumProfileSeq([
                        'profileid' => 'PROF1'
                    ])

                ]))
            ]))
            ->addPortingRequestSeq(new PortingRequestSeq([
                'numberseries' => new NumberSeries([
                    'start' => '0223456789',
                    'end' => '0987654322'
                ])
            ]));
        $portingrequest = $builder->build();

        echo($portingrequest);

        $this->assertStringStartsWith("{\"message\"", $portingrequest->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"portingrequest"', $portingrequest->__toString(), "Message should contain a body with a cancel declaration");
    }

    public function testPortingRequestMessageCanBeCreated2()
    {
        date_default_timezone_set('Europe/Amsterdam');

        $builder = PortingRequestBuilder::create();
        $builder
            ->setFullHeader("LOADA", "LOADA", "LOADB", "LOADB")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("123456")
            ->setNote("Just a note!")
            ->setCustomerInfo("Test", "Vereniging COIN", "10", "a", "1111AA", "123456")
            ->addActivationServiceNumberSequence()
                ->setNumberSeries("01234567789", "01234567789")
                ->setProfileIds(["PROF1", "PROF2"])
                ->finish()
            ->addActivationServiceNumberSequence()
                ->setNumberSeries("01234567789", "01234567789")
                ->setProfileIds(["PROF1", "PROF2"])
                ->finish();
        $portingrequest = $builder->build();

        echo($portingrequest);

        $this->assertStringStartsWith("{\"message\"", $portingrequest->__toString(), "Message should start with message declaration");
        $this->assertStringContainsString('"body":{"portingrequest"', $portingrequest->__toString(), "Message should contain a body with a cancel declaration");
    }
}
