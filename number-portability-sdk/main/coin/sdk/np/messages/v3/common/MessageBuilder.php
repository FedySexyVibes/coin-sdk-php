<?php

namespace coin\sdk\np\messages\v3\common;

use coin\sdk\np\messages\v3\model\Header;
use coin\sdk\np\messages\v3\model\Receiver;
use coin\sdk\np\messages\v3\model\Sender;

interface INPMessageBuilder extends INPHeaderBuilder {

    /**
     * @return Message
     */
    public function build();

    public static function create();
}

abstract class NPMessageBuilder implements INPMessageBuilder {
    protected abstract function getThis();

    protected $header;

    protected function __construct()
    {
        $this->header = new Header();
    }

    public function setHeader($senderNetworkOperator, $receiverNetworkOperator, $senderServiceProvider = null, $receiverServiceProvider = null)
    {
        $this->header->setSender(new Sender(array('networkoperator' => $senderNetworkOperator, 'serviceprovider' => $senderServiceProvider)));
        $this->header->setReceiver(new Receiver(array('networkoperator' => $receiverNetworkOperator, 'serviceprovider' => $receiverServiceProvider)));
        return $this;
    }

    public function setTimestamp($timestamp) {
        $this->header->setTimestamp($timestamp);
        return $this;
    }
}

interface EnumBuilder extends INPMessageBuilder {
    public function addRepeatsItem($repeatsItem);
}
