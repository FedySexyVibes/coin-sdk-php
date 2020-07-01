<?php

namespace coin\sdk\bs\messages\v4\common;

interface IBSHeaderBuilder
{
    public function setHeader($senderServiceProvider, $receiverServiceProvider, $senderNetworkOperator = null, $receiverNetworkOperator = null);
    public function setMessageid($messageid);
    public function setTimestamp($timestamp);
}
