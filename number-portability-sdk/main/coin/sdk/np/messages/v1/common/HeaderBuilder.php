<?php

namespace coin\sdk\np\messages\v1\common;

interface INPHeaderBuilder
{
    public function setHeader($senderNetworkOperator, $receiverNetworkOperator, $senderServiceProvider = null, $receiverServiceProvider = null);
}
