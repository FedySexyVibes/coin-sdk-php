<?php

namespace coin\sdk\bs\service\impl;

use coin\sdk\bs\messages\v4\CancelMessage;
use coin\sdk\bs\messages\v4\ContractTerminationPerformedMessage;
use coin\sdk\bs\messages\v4\ContractTerminationRequestAnswerMessage;
use coin\sdk\bs\messages\v4\ContractTerminationRequestMessage;
use coin\sdk\bs\messages\v4\ErrorFoundMessage;

interface IBundleSwitchingMessageListener {

    // Handling of keepalive messages en exceptions
    function onKeepAlive();
    function onException($exception);
    function onUnknownMessage($messageId, $message);

    // Handling of the bundle switching message types
    function onCancel($messageId, CancelMessage $message);
    function onContractTerminationRequest($messageId, ContractTerminationRequestMessage $message);
    function onContractTerminationRequestAnswer($messageId, ContractTerminationRequestAnswerMessage $message);
    function onContractTerminationPerformed($messageId, ContractTerminationPerformedMessage $message);
    function onErrorFound($messageId, ErrorFoundMessage $message);
}

interface IBundleSwitchingService {
    function sendConfirmation($id);
    function sendMessage($message);
}
