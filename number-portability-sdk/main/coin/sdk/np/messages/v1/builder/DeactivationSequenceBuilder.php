<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\ActivationServiceNumberSeq;
use coin\sdk\np\messages\v1\DeactivationSeq;
use coin\sdk\np\messages\v1\NumberSeries;
use coin\sdk\np\messages\v1\TariffInfo;

class DeactivationSequenceBuilder
{
    private $deactivationSequence;
    private $parent;

    public function __construct($parent) {
        $this->parent = $parent;
        $this->deactivationSequence = new DeactivationSeq();
    }

    public function setNumberSeries($start, $end) {
        $numberSeries = new NumberSeries();
        $numberSeries->setStart($start);
        $numberSeries->setEnd($end);
        $this->deactivationSequence->setNumberseries($numberSeries);
        return $this;
    }

    public function finish() {
        $this->parent->addRepeatsItem($this->deactivationSequence);
        return $this->parent;
    }
}