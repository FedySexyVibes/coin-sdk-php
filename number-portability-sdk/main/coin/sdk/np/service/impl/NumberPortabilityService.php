<?php

use coin\sdk\common\client\CtpApiRestTemplateSupport;
use coin\sdk\np\messages\v1\common\Message;

class NumberPortabilityService extends CtpApiRestTemplateSupport
{

    private $apiUrl;

    public function __construct($consumerName = null, $privateKeyFile = null, $encryptedHmacSecretFile = null, $validPeriodInSeconds = 30, $coinBaseUrl = null) {
        parent::__construct(
            $consumerName,
            $privateKeyFile,
            $encryptedHmacSecretFile,
            $validPeriodInSeconds
        );
        $this->apiUrl = ($coinBaseUrl ?: @$_ENV['COIN_BASE_URL'] ?: $GLOBALS['CoinBaseUrl']).'/number-portability/v1';
    }

    /**
     * @param Message $message
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function sendMessage($message) {
        return $this->postMessage($message, $message->getMessageType());
    }

    public function sendConfirmation($id) {
        // TODO Enable the sendConfirmation message!
//        $confirmationMessage = new ConfirmationMessage().transactionId(id);
//        $url = this$apiUrl + "/dossiers/" + MessageType.CONFIRMATION_V1.getType() + "/" + id;
//        sendWithToken(String.class, HttpMethod.PUT, url, confirmationMessage);
    }

    function postMessage($message, $messageType) {
        $url = $this->apiUrl . "/dossiers/" . $messageType;
        return parent::sendWithToken("POST", $url, $message);

        //TODO Error checking
    }
}
