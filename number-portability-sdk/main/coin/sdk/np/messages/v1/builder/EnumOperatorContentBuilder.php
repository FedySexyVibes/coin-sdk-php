<?php

namespace coin\sdk\np\messages\v1\builder;

use coin\sdk\np\messages\v1\common\EnumBuilder;
use coin\sdk\np\messages\v1\EnumOperatorSeq;

class EnumOperatorContentBuilder
{
    private $enumOperatorSequence;
    private $parent;

    public function __construct(EnumBuilder $parent) {
        $this->parent = $parent;
        $this->enumOperatorSequence = new EnumOperatorSeq();
    }

    public function setProfileId($profileId) {
        $this->enumOperatorSequence->setProfileid($profileId);

        return $this;
    }

    public function setDefaultService($defaultService) {
        $this->enumOperatorSequence->setDefaultservice($defaultService);

        return $this;
    }

    public function finish() {
        $this->parent->addRepeatsItem($this->enumOperatorSequence);
        return $this->parent;
    }

}
