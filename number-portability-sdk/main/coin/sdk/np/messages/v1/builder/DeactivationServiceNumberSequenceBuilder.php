<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\ActivationServiceNumberSeq;
use coin\sdk\np\messages\v1\NumberSeries;
use coin\sdk\np\messages\v1\TariffInfo;

class DeactivationServiceNumberSequenceBuilder
{

    private $deactivationServiceNumberSequence;
    private $parent;

    public function __construct($parent) {
        $this->parent = $parent;
        $this->deactivationServiceNumberSequence = new ActivationServiceNumberSeq();
    }

    public function setNumberSeries($start, $end) {
        $numberSeries = new NumberSeries();
        $numberSeries->setStart($start);
        $numberSeries->setEnd($end);
        $this->deactivationServiceNumberSequence->setNumberseries($numberSeries);
        return $this;
    }

    public function setPop($pop) {
        $this->deactivationServiceNumberSequence->setPop($pop);
        return $this;
    }

    public function finish() {
        $this->parent->addRepeatsItem($this->deactivationServiceNumberSequence);
        return $this->parent;
    }
}