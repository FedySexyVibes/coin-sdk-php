<?php

namespace common\client;


use common\crypto\CtpApiClientUtil;

abstract class CtpApiRestTemplateSupport {

    var $hmacSecret;
    var $privateKey;
    var $consumerName;
    var $validPeriodInSeconds;

    function __construct($consumerName, $privateKeyFile, $encryptedHmacSecretFile, $validPeriodInSeconds = 30) {
        $this->privateKey = CtpApiClientUtil::readPrivateKeyFile($privateKeyFile);
        $this->hmacSecret = CtpApiClientUtil::hmacSecretFromEncryptedFile($encryptedHmacSecretFile, $this->privateKey);
        $this->consumerName = $consumerName;
        $this->validPeriodInSeconds = $validPeriodInSeconds;
    }

    /**
     * @param int $method
     * @param string $url
     * @param string $content [optional]
     * @return \HttpMessage
     */
    protected function SendWithToken($method, $url, $content = null) {
        $request = new \HttpRequest($url, $method);
        $request->setBody($content);
        $hmacHeaders = CtpApiClientUtil::getHmacHeaders($content);
        $request->addHeaders($hmacHeaders);

        $methodName = http_request_method_name($method);
        $localPath = parse_url($url, PHP_URL_PATH);
        $requestLine = "$methodName $localPath HTTP/1.1";
        $hmac = CtpApiClientUtil::CalculateHttpRequestHmac($this->hmacSecret, $this->consumerName, $hmacHeaders, $requestLine);

        $jwt = CtpApiClientUtil::createJwt($this->privateKey, $this->consumerName, $this->validPeriodInSeconds);

        $request->addHeaders(array(
            "authorization" => $hmac,
            "User-Agent" => "coin-sdk-php-v0.0.0",
            "Cookie" => "jwt=$jwt"
        ));
        return $request->send();
    }
}
