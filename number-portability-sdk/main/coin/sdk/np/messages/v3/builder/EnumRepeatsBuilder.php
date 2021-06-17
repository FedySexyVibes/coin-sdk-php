<?php

namespace coin\sdk\np\messages\v3\builder;

use coin\sdk\np\messages\v3\model\EnumProfileSeq;
use coin\sdk\np\messages\v3\model\EnumRepeats;

class EnumRepeatsBuilder {
    private $profileIds;

    public function setProfileIds($profileIds) {
        $this->profileIds = $profileIds;
        return $this;
    }

    public function build() {
        $enumRepeats = array();
        foreach ($this->profileIds as $profileId) {
            $enumProfileSeq = new EnumProfileSeq();
            $enumProfileSeq->setProfileid($profileId);
            array_push($enumRepeats, new EnumRepeats(["seq" => $enumProfileSeq]));
        }
        return count($enumRepeats) == 0 ? null : $enumRepeats;
    }
}

