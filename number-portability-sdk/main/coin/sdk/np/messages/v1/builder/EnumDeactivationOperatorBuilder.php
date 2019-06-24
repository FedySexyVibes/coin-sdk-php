<?php


namespace coin\sdk\np\messages\v1\builder;


use coin\sdk\np\messages\v1\common\Message;
use coin\sdk\np\messages\v1\common\MessageBuilder;
use coin\sdk\np\messages\v1\common\MessageType;
use coin\sdk\np\messages\v1\EnumContent;
use coin\sdk\np\messages\v1\EnumDeactivationOperatorBody;
use coin\sdk\np\messages\v1\EnumDeactivationOperatorMessage;
use coin\sdk\np\messages\v1\Header;

class EnumDeactivationOperatorBuilder extends MessageBuilder
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
        $enumDeactivationOperatorMessage = new EnumDeactivationOperatorMessage();
        $enumDeactivationOperatorMessage->setHeader($this->header);
        $enumDeactivationOperatorBody = new EnumDeactivationOperatorBody();
        $enumDeactivationOperatorMessage->setBody($enumDeactivationOperatorBody->setEnumDeactivationoperator($this->enumContent));
        return new Message($enumDeactivationOperatorMessage, MessageType::ENUM_DEACTIVATION_OPERATOR);
    }
}