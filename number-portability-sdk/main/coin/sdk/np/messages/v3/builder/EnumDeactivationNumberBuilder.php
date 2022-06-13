<?php


namespace coin\sdk\np\messages\v3\builder;


use coin\sdk\np\messages\v3\common\EnumBuilder;
use coin\sdk\np\messages\v3\common\Message;
use coin\sdk\np\messages\v3\common\NPMessageBuilder;
use coin\sdk\np\messages\v3\common\MessageType;
use coin\sdk\np\messages\v3\model\EnumContent;
use coin\sdk\np\messages\v3\model\EnumDeactivationNumberBody;
use coin\sdk\np\messages\v3\model\EnumDeactivationNumberMessage;
use coin\sdk\np\messages\v3\model\EnumNumberRepeats;
use coin\sdk\np\messages\v3\model\Header;

class EnumDeactivationNumberBuilder extends NPMessageBuilder implements EnumBuilder
{
    private $enumContent;
    private $repeats;

    public function getThis()
    {
        return $this;
    }

    protected function __construct() {
        parent::__construct();
        $this->enumContent = new EnumContent();
        $this->header = new Header();
        $this->repeats = array();
    }

    public static function create()
    {
        return new self;
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

    public function addEnumNumberSequence() {
        return new EnumContentBuilder($this);
    }

    public function addRepeatsItem($repeatsItem) {
        array_push($this->repeats, new EnumNumberRepeats(["seq" => $repeatsItem]));
    }

    public function build() {
        if (sizeof($this->repeats, 0) > 0) {
            $this->enumContent->setRepeats($this->repeats);
        }
        $enumDeactivationNumberMessage = new EnumDeactivationNumberMessage();
        $enumDeactivationNumberMessage->setHeader($this->header);
        $enumDeactivationNumberBody = new EnumDeactivationNumberBody();
        $enumDeactivationNumberMessage->setBody($enumDeactivationNumberBody->setEnumDeactivationnumber($this->enumContent));
        return new Message($enumDeactivationNumberMessage, MessageType::ENUM_DEACTIVATION_NUMBER);
    }
}