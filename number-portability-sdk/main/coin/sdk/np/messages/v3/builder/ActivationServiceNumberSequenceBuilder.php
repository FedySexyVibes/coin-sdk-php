<?php

namespace coin\sdk\np\messages\v3\builder;

use coin\sdk\np\messages\v3\model\ActivationServiceNumberSeq;
use coin\sdk\np\messages\v3\model\NumberSeries;
use coin\sdk\np\messages\v3\model\TariffInfo;

class ActivationServiceNumberSequenceBuilder
{

    private $activationServiceNumberSequence;
    private $parent;

    public function __construct(ActivationServiceNumberBuilder $parent) {
        $this->parent = $parent;
        $this->activationServiceNumberSequence = new ActivationServiceNumberSeq();
    }

    public function setNumberSeries($start, $end) {
        $numberSeries = new NumberSeries();
        $numberSeries->setStart($start);
        $numberSeries->setEnd($end);
        $this->activationServiceNumberSequence->setNumberseries($numberSeries);
        return $this;
    }

    public function setTariffInfo($peak, $offPeak, $currency, $type, $vat) {
        $tariffInfo = new TariffInfo();
        $tariffInfo->setPeak($peak);
        $tariffInfo->setOffpeak($offPeak);
        $tariffInfo->setCurrency($currency);
        $tariffInfo->setType($type);
        $tariffInfo->setVat($vat);
        $this->activationServiceNumberSequence->setTariffinfo($tariffInfo);
        return $this;
    }

    public function setPop($pop) {
        $this->activationServiceNumberSequence->setPop($pop);
        return $this;
    }

    public function finish() {
        $this->parent->addRepeatsItem($this->activationServiceNumberSequence);
        return $this->parent;
    }

}
