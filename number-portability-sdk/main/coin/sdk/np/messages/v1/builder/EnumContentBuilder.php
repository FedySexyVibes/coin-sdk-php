<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\EnumContent;
use coin\sdk\np\messages\v1\EnumNumberRepeats;
use coin\sdk\np\messages\v1\EnumNumberSeq;
use coin\sdk\np\messages\v1\NumberSeries;

class EnumContentBuilder
{
    private $enumNumberSequence;
    private $parent;

    public function __construct($parent) {
        $this->parent = $parent;
        $this->enumNumberSequence = new EnumNumberSeq();
    }

    public function setNumberSeries($start, $end) {
        $numberSeries = new NumberSeries();
        $numberSeries->setStart($start);
        $numberSeries->setEnd($end);
        $this->enumNumberSequence->setNumberseries($numberSeries);
        return $this;
    }

    public function setProfileIds($profileIds) {
        $enumRepeats = new EnumRepeatsBuilder();
        $enumRepeats->setProfileIds($profileIds);
        $this->enumNumberSequence->setRepeats($enumRepeats->build());

        return $this;
    }

    public function finish() {
        $this->parent->addRepeatsItem($this->enumNumberSequence);
        return $this->parent;
    }

}