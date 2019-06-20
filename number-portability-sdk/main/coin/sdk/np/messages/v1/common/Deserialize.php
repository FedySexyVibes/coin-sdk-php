<?php

namespace coin\sdk\np\messages\v1\common;

use coin\sdk\np\messages\v1;

function deserialize($type, $message) {
    switch ($type) {
        case "activationsn-v1": return new v1\ActivationServiceNumberEnvelope($message);
        case "cancel-v1": return new v1\CancelEnvelope($message);
        case "deactivation-v1": return new v1\DeactivationEnvelope($message);
        case "deactivationsn-v1": return new v1\DeactivationServiceNumberEnvelope($message);
        case "enumactivationnumber-v1": return new v1\EnumActivationNumberEnvelope($message);
        case "enumactivationoperator-v1": return new v1\EnumActivationOperatorEnvelope($message);
        case "enumactivationrange-v1": return new v1\EnumActivationRangeEnvelope($message);
        case "enumdeactivationnumber-v1": return new v1\EnumDeactivationNumberEnvelope($message);
        case "enumdeactivationoperator-v1": return new v1\EnumDeactivationOperatorEnvelope($message);
        case "enumdeactivationrange-v1": return new v1\EnumDeactivationRangeEnvelope($message);
        case "enumprofileactivation-v1": return new v1\EnumProfileActivationEnvelope($message);
        case "enumprofiledeactivation-v1": return new v1\EnumProfileDeactivationEnvelope($message);
        case "errorfound-v1": return new v1\ErrorFoundEnvelope($message);
        case "portingperformed-v1": return new v1\PortingPerformedEnvelope($message);
        case "portingrequest-v1": return new v1\PortingRequestEnvelope($message);
        case "portingrequestanswer-v1": return new v1\PortingRequestAnswerEnvelope($message);
        case "pradelayed-v1": return new v1\PortingRequestAnswerDelayedEnvelope($message);
        case "rangeactivation-v1": return new v1\RangeActivationEnvelope($message);
        case "rangedeactivation-v1": return new v1\RangeDeactivationEnvelope($message);
        case "tariffchangesn-v1": return new v1\TariffChangeServiceNumberEnvelope($message);
        default: throwException(new \Exception("Unknown message type $type"));
    }
}
