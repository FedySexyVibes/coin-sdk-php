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

### Sample Project for the Number Portability API
- A sample project is provided in the `number-portability-sdk-samples` directory.


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

| $ENV | $GLOBALS |
|---|---|
| CONSUMER_NAME | ConsumerName |
| PRIVATE_KEY_FILE | PrivateKeyFile |
| ENCRYPTED_HMAC_SECRET_FILE | EncryptedHmacSecretFile |
| COIN_BASE_URL | CoinBaseUrl |


## Send Messages

The `NumberPortabilityService` has a `sendMessage` method to send any number portability message to the API. The Number Portability SDK contains Builders to construct the various messages. If there are sequnences in the message
than there is an add method to add an instance. Each instance should be ended with the finish() method.

```php
        $builder = PortingRequestBuilder::create();
        $builder
            ->setFullHeader("LOADA", "LOADA", "LOADB", "LOADB")
            ->setTimestamp(date("Ymdhis", time()))
            ->setDossierId("123456")
            ->setNote("Just a note!")
            ->setCustomerInfo("Test", "Vereniging COIN", "10", "a", "1111AA", "123456")
            ->addPortingRequestNumberSequence()
                ->setNumberSeries("0611111111", "0611111112")
                ->setProfileIds(["PROF1", "PROF2"]) // optional
                ->finish()
            ->addPortingRequestNumberSequence()
                ->setNumberSeries("0622222222", "0622222223")
                ->setProfileIds(["PROF1", "PROF2"]) // optional
                ->finish();
        $portingrequest = $builder->build();
```

## Consume Messages

An instance of the `INumberPortabilityMessageListener` needs to be passed to the `NumberPortabilityMessageConsumer`'s `getMessages` method.
This method connects to the SSE stream and returns a generator of messages. Before yielding each message, this generator calls the
`INumberPortabilityMessageListener`'s `onMessage` function and, if present, the `$offsetPersister`'s `setOffset` method. Whenever something goes wrong in processing a message, it yields the original
server-sent event with an additional `exception` field.

By default, the `NumberPortabilityMessageConsumer` consumes all ***Unconfirmed*** messages. 


#### Consume specific messages using filters
The `NumberPortabilityMessageConsumer` provides various filters for message consumption. The filters are:
- `MessageType`: All possible message types, including errors. Use the `MessageType`-enumeration to indicate which messages have to be consumed.
- ConfirmationStatus: 
    - `ConfirmationStatus.Unconfirmed`: consumes all unconfirmed messages. Upon (re)-connection all unconfirmed messages are served.
    - `ConfirmationStatus.All`: consumes confirmed and unconfirmed messages.  
    **Note:** this filter enables the consumption of the *whole message history*.
    Therefore, this filter requires you to supply an implementation of the `IOffsetPersister` interface.
    The purpose of this interface is to track the `messageId` of the last received and processed message.
    In case of a reconnect, message consumption will then resume where it left off.
- `offset`: starts consuming messages based on the given `messageId` offset.
When using `ConfirmationStatus.Unconfirmed`, the `offset` is in most cases not very useful. The `ConfirmationStatus.All` filter is better.
***Note:*** it is the responsibility of the client to keep track of the `offset`.

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
