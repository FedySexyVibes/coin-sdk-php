<?php

namespace coin\sdk\bs\messages\v5\common;

use coin\sdk\bs\messages\v5\Header;
use coin\sdk\bs\messages\v5\Receiver;
use coin\sdk\bs\messages\v5\Sender;

interface IBSMessageBuilder extends IBSHeaderBuilder {

    /**
     * @return Message
     */
    public function build();

    public static function create();
}

abstract class BSMessageBuilder implements IBSMessageBuilder {
    protected abstract function getThis();

    protected $header;

    protected function __construct()
    {
        $this->header = new Header();
    }

    public function setHeader($senderServiceProvider, $receiverServiceProvider, $senderNetworkOperator = null, $receiverNetworkOperator = null)
    {
        $this->header->setSender(new Sender(array('networkoperator' => $senderNetworkOperator, 'serviceprovider' => $senderServiceProvider)));
        $this->header->setReceiver(new Receiver(array('networkoperator' => $receiverNetworkOperator, 'serviceprovider' => $receiverServiceProvider)));
        $this->setTimestamp(date( 'Y-m-d\TH:i:s', time()));
        return $this;
    }

    public function setMessageid($messageid) {
        $this->header->setMessageid($messageid);
    }

    public function setTimestamp($timestamp) {
        $this->header->setTimestamp($timestamp);
        return $this;
    }
}

interface EnumBuilder extends IBSMessageBuilder {
    public function addRepeatsItem($repeatsItem);
}
