<?php

namespace coin\sdk\np\messages\v3\builder;

use coin\sdk\np\messages\v3\model\DeactivationSeq;
use coin\sdk\np\messages\v3\model\NumberSeries;

class DeactivationSequenceBuilder
{
    private $deactivationSequence;
    private $parent;

    public function __construct(DeactivationBuilder $parent) {
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
