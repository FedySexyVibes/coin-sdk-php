<?php

namespace coin\sdk\np\service\impl;

interface INumberPortabilityMessageListener {

    // Handling of keepalive messages en exceptions
    function onKeepAlive();
    function onException($exception);
    function onUnknownMessage($messageId, $message);

    // Handling of the number-portability message types
    function onActivationServiceNumber($messageId, $message);
    function onCancel($messageId, $message);
    function onDeactivation($messageId, $message);
    function onDeactivationServiceNumber($messageId, $message);
    function onEnumActivationNumber($messageId, $message);
    function onEnumActivationOperator($messageId, $message);
    function onEnumActivationRange($messageId, $message);
    function onEnumDeactivationNumber($messageId, $message);
    function onEnumDeactivationOperator($messageId, $message);
    function onEnumDeactivationRange($messageId, $message);
    function onEnumProfileActivation($messageId, $message);
    function onEnumProfileDeactivation($messageId, $message);
    function onErrorFound($messageId, $message);
    function onPortingRequest($messageId, $message);
    function onPortingRequestAnswer($messageId, $message);
    function onPortingRequestAnswerDelayed($messageId, $message);
    function onPortingPerformed($messageId, $message);
    function onRangeActivation($messageId, $message);
    function onRangeDeactivation($messageId, $message);
    function onTariffChangeServiceNumber($messageId, $message);
}

interface INumberPortabilityService {
    function sendConfirmation($id);
    function sendMessage($message);
}

interface IOffsetPersister {
    function getOffset();
    function setOffset($offset);
}
