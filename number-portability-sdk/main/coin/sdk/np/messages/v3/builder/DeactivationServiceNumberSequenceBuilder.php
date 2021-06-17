<?php

namespace coin\sdk\np\messages\v3\builder;

use coin\sdk\np\messages\v3\model\DeactivationServiceNumberSeq;
use coin\sdk\np\messages\v3\model\NumberSeries;

class DeactivationServiceNumberSequenceBuilder
{

    private $deactivationServiceNumberSequence;
    private $parent;

    public function __construct(DeactivationServiceNumberBuilder $parent) {
        $this->parent = $parent;
        $this->deactivationServiceNumberSequence = new DeactivationServiceNumberSeq();
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
