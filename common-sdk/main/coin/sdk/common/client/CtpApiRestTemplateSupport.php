<?php

namespace coin\sdk\common\client;

use coin\sdk\common\crypto\CtpApiClientUtil;
use GuzzleHttp\Client;

abstract class CtpApiRestTemplateSupport
{

    var $hmacSecret;
    var $privateKey;
    var $consumerName;
    var $validPeriodInSeconds;

    function __construct($consumerName, $privateKeyFile, $encryptedHmacSecretFile, $validPeriodInSeconds = 30)
    {
        $this->privateKey = CtpApiClientUtil::readPrivateKeyFile($privateKeyFile);
        $this->hmacSecret = CtpApiClientUtil::hmacSecretFromEncryptedFile($encryptedHmacSecretFile, $this->privateKey);
        $this->consumerName = $consumerName;
        $this->validPeriodInSeconds = $validPeriodInSeconds;
    }

    /**
     * @param int $method
     * @param string $url
     * @param string $content [optional]
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function SendWithToken($method, $url, $content = null)
    {
        $client = new Client();
        $hmacHeaders = CtpApiClientUtil::getHmacHeaders($content);
        $methodName = $method;
        $localPath = parse_url($url, PHP_URL_PATH);
        $requestLine = "$methodName $localPath HTTP/1.1";
        $hmac = CtpApiClientUtil::CalculateHttpRequestHmac($this->hmacSecret, $this->consumerName, $hmacHeaders, $requestLine);
        $jwt = CtpApiClientUtil::createJwt($this->privateKey, $this->consumerName, $this->validPeriodInSeconds);
        return $client->request($method, $url, [
            'body' => $content,
            'headers' => array_merge($hmacHeaders, array(
                "authorization" => $hmac,
                "User-Agent" => "coin-sdk-php-v0.0.0",
                'content-type' => 'application/json',
                "Cookie" => "jwt=$jwt")
            )
        ]);

    }
}
