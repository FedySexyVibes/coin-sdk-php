<?php

use coin\sdk\common\client\CtpApiRestTemplateSupport;

class NumberPortabilityService extends CtpApiRestTemplateSupport
{

    private $apiUrl;

    public function __construct($consumerName, $privateKeyFile, $encryptedHmacSecretFile, $validPeriodInSeconds = 30) {
        parent::__construct(
            $consumerName,
            $privateKeyFile,
            $encryptedHmacSecretFile,
            $validPeriodInSeconds
        );

        $this->apiUrl = "http://localhost:9010/number-portability/v1";
    }

    public function sendMessage($message) {
        $this->postMessage($message, $message->getMessageType());
    }

    public function sendConfirmation($id) {
        // TODO Enable the sendConfirmation message!
//        $confirmationMessage = new ConfirmationMessage().transactionId(id);
//        $url = this$apiUrl + "/dossiers/" + MessageType.CONFIRMATION_V1.getType() + "/" + id;
//        sendWithToken(String.class, HttpMethod.PUT, url, confirmationMessage);
    }

    public function postMessage($message, $messageType) {
        $url = $this->apiUrl . "/dossiers/" . $messageType;
        $repsonseBody = parent::sendWithToken("POST", $url, $message);

        //TODO Error checking
    }
}
