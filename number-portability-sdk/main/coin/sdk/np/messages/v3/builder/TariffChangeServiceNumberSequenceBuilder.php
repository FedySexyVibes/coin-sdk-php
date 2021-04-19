<?php

namespace coin\sdk\np\messages\v3\builder;

use coin\sdk\np\messages\v3\model\NumberSeries;
use coin\sdk\np\messages\v3\model\TariffChangeServiceNumberSeq;
use coin\sdk\np\messages\v3\model\TariffInfo;

class TariffChangeServiceNumberSequenceBuilder
{

    private $tariffChangeServiceNumberSeq;
    private $parent;

    public function __construct(TariffChangeServiceNumberBuilder $parent) {
        $this->parent = $parent;
        $this->tariffChangeServiceNumberSeq = new TariffChangeServiceNumberSeq();
    }

    public function setNumberSeries($start, $end) {
        $numberSeries = new NumberSeries();
        $numberSeries->setStart($start);
        $numberSeries->setEnd($end);
        $this->tariffChangeServiceNumberSeq->setNumberseries($numberSeries);
        return $this;
    }

    public function setTariffInfoNew($peak, $offPeak, $currency, $type, $vat) {
        $tariffInfo = new TariffInfo();
        $tariffInfo->setPeak($peak);
        $tariffInfo->setOffpeak($offPeak);
        $tariffInfo->setCurrency($currency);
        $tariffInfo->setType($type);
        $tariffInfo->setVat($vat);
        $this->tariffChangeServiceNumberSeq->setTariffinfonew($tariffInfo);
        return $this;
    }

    public function finish() {
        $this->parent->addRepeatsItem($this->tariffChangeServiceNumberSeq);
        return $this->parent;
    }
}
