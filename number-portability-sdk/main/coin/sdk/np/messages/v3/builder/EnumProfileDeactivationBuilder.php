<?php

namespace coin\sdk\np\messages\v3\builder;

use coin\sdk\np\messages\v3\common\Message;
use coin\sdk\np\messages\v3\common\NPMessageBuilder;
use coin\sdk\np\messages\v3\common\MessageType;
use coin\sdk\np\messages\v3\model\EnumProfileDeactivation;
use coin\sdk\np\messages\v3\model\EnumProfileDeactivationBody;
use coin\sdk\np\messages\v3\model\EnumProfileDeactivationMessage;
use coin\sdk\np\messages\v3\model\Header;

class EnumProfileDeactivationBuilder extends NPMessageBuilder
{
    private $enumProfileDeactivation;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->enumProfileDeactivation = new EnumProfileDeactivation();
        $this->header = new Header();
    }

    public static function create()
    {
        return new self;
    }

    public function setDossierId($dossierId) {
        $this->enumProfileDeactivation->setDossierId($dossierId);
        return $this;
    }

    public function setCurrentNetworkOperator($currentNetworkOperator) {
        $this->enumProfileDeactivation->setCurrentnetworkoperator($currentNetworkOperator);
        return $this;
    }

    public function setProfileId($profileId) {
        $this->enumProfileDeactivation->setProfileid($profileId);
        return $this;
    }

    public function setTypeOfNumber($typeOfNumber) {
        $this->enumProfileDeactivation->setTypeofnumber($typeOfNumber);
        return $this;
    }

    public function build() {
        $enumProfileDeactivationMessage = new EnumProfileDeactivationMessage();
        $enumProfileDeactivationMessage->setHeader($this->header);
        $enumProfileDeactivationBody = new EnumProfileDeactivationBody();
        $enumProfileDeactivationMessage->setBody($enumProfileDeactivationBody->setEnumprofileDeactivation($this->enumProfileDeactivation));
        return new Message($enumProfileDeactivationMessage, MessageType::ENUM_PROFILE_DEACTIVATION);
    }
}
