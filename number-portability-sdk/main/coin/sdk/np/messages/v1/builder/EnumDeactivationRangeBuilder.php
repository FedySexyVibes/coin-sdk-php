<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\EnumContent;
use coin\sdk\np\messages\v1\EnumDeactivationRangeBody;
use coin\sdk\np\messages\v1\EnumDeactivationRangeMessage;
use coin\sdk\np\messages\v1\Header;

class EnumDeactivationRangeBuilder extends MessageBuilder
{
    private $enumContent;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->enumContent = new EnumContent();
        $this->header = new Header();
    }

    public static function create()
    {
        $builder = new self;
        return $builder;
    }

    public function setCurrentNetworkOperator($currentNetworkOperator) {
        $this->enumContent->setCurrentnetworkoperator($currentNetworkOperator);
        return $this;
    }

    public function setDossierId($dossierId) {
        $this->enumContent->setDossierId($dossierId);
        return $this;
    }

    public function setTypeOfNumber($typeOfNumber) {
        $this->enumContent->setTypeofnumber($typeOfNumber);
        return $this;
    }

    // TODO Add Repeats

    public function build() {
        $enumDeactivationRangeMessage = new EnumDeactivationRangeMessage();
        $enumDeactivationRangeMessage->setHeader($this->header);
        $enumDeactivationRangeBody = new EnumDeactivationRangeBody();
        $enumDeactivationRangeMessage->setBody($enumDeactivationRangeBody->setEnumDeactivationrange($this->enumContent));
        return new Message($enumDeactivationRangeMessage, MessageType::ENUM_DEACTIVATION_RANGE);
    }
}