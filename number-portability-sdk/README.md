# PHP Number Portability SDK

## Introduction

This SDK supports secured access to the number portability API.

For a quick start, follow the steps below:
* [Setup](#setup)
* [Configure Credentials](#configure-credentials)
* [Send Messages](#send-messages)
* [Consume Messages](#consume-messages)
* [Error handling](#error-handling)


## Setup

#### Usage
Run `composer require coin/sdk` in your own project to use this SDK.

#### Sample Project for the Number Portability API
A sample project is provided in the [number-portability-sdk-samples](https://gitlab.com/verenigingcoin-public/coin-sdk-php/tree/master/number-portability-sdk-samples) directory.


## Configure Credentials

For secure access credentials are required.
- Check the [README introduction](../README.md#introduction) to find out how to configure these.
- In summary you will need:
    - a consumer name
    - a private key file
    - a file containing the encrypted Hmac secret
    - the base url of the Coin platform you are using
- These can be used to create instances of the `NumberPortabilityService` and the `NumberPortabilityMessageConsumer`.
If you instantiate these without consumer name etc., the required values will be searched in `$_ENV` and subsequently in `$GLOBALS`
under the following names:

| $_ENV | $GLOBALS |
|---|---|
| CONSUMER_NAME | ConsumerName |
| PRIVATE_KEY_FILE | PrivateKeyFile |
| ENCRYPTED_HMAC_SECRET_FILE | EncryptedHmacSecretFile |
| COIN_BASE_URL | CoinBaseUrl |

For populating the `$_ENV` variable, [PHP dotenv](https://github.com/vlucas/phpdotenv) could be used.

## Send Messages

The `NumberPortabilityService` has a `sendMessage` method to send any number portability message to the API.
The Number Portability SDK contains Builders to construct the various messages. If there are sequences in the message,
there is an 'add' method to add an instance. Each instance should be ended with the finish() method.
A simple class for sending porting messages could look something like this:

```php
<?php

use coin\sdk\np\messages\v1\builder\PortingRequestBuilder;
use coin\sdk\np\service\impl\NumberPortabilityService;

class MySender
{
    private $operator;
    private $service;

    public function __construct()
    {
        $this->service = new NumberPortabilityService();
        $this->operator = 'Your OperatorCode';
    }

    public function SendPortingRequest($id, $begin, $end)
    {
        $message = PortingRequestBuilder::create()
                ->setHeader($this->operator, 'CRDB', $this->operator)
                ->setTimestamp(date("Ymdhis", time()))
                ->setDossierId("$this->operator-$id")
                ->setNote("Just a note!") // optional
                ->setCustomerInfo("Test", "Vereniging COIN", "10", "a", "1111AA", "123456") // optional
                ->setRecipientnetworkoperator($this->operator)
                ->addPortingRequestSequence()
                    ->setNumberSeries($begin, $end)
                    ->setProfileIds(["PROF1", "PROF2"]) // optional
                    ->finish()
                // you can add more sequences if you want
                ->build();
        return $this->service->sendMessage($message);
    }
}
```

## Consume Messages

### Create Message Listener
For message consumption, the number portability API makes use of HTTP's [ServerSentEvents](https://en.wikipedia.org/wiki/Server-sent_events).
The SDK offers a Listener interface `INumberPortabilityMessageListener` which is triggered upon reception of a message payload.

### Start consuming messages 
The `NumberPortabilityMessageConsumer` has three `consume...()` methods for consuming messages, of which `consumeUnconfirmed()` is most useful.
All these methods need an instance of the `INumberPortabilityMessageListener`. These methods return a Generator of `message-id`s; iterating over this
Generator causes the messages to be consumed.

### Consume specific messages using filters
The `NumberPortabilityMessageConsumer` provides various filters for message consumption. The filters are:
- `MessageType`: All possible message types, including errors. Use the `MessageType`-enumeration to indicate which messages have to be consumed.
- confirmation status: By using `consumeAll()`, all messages will be received, both confirmed and unconfirmed.   
    **Note:** this enables the consumption of the *whole message history*.
    Therefore, this requires you to supply an implementation of the `IOffsetPersister` interface.
    The purpose of this interface is to track the `message-id` of the last received and processed message.
    In case of a reconnect, message consumption will then resume where it left off.
- `offset`: starts consuming messages based on the given `message-id` offset. ***Note:*** it is the responsibility of the client to keep track of the `offset`.

#### Confirm Messages
Once a consumed message is processed it needs to be confirmed.
To confirm a message use the `NumberPortabilityService.sendConfirmation(id)` method.


## Error Handling

The number portability API can return errors in two ways:

1. The server received an incorrect payload and replies with an error response (synchronous)

    The REST layer of the system only performs basic payload checks, such as swagger schema validity and message authorization.
    Any errors in these checks are immediately returned as an error reply.
    
2. As a ServerSentEvent containing an `ErrorFoundMessage` (asynchronous)

    The system performs detailed functional validation, such as number range validation, asynchronously.
    Errors in this stage are sent in the event stream as `ErrorFound` messages.
    ***Note:*** These need to be confirmed like any other message received through the event stream.
