# PHP Bundle Switching SDK

## Introduction

This SDK supports secured access to the bundle switching API.

For a quick start, follow the steps below:
* [Setup](#setup)
* [Configure Credentials](#configure-credentials)
* [Send Messages](#send-messages)
* [Consume Messages](#consume-messages)
* [Error handling](#error-handling)


## Setup

#### Usage
Run `composer require coin/sdk` in your own project to use this SDK.

#### Sample Project for the Bundle Switching API
A sample project is provided in the [bundle-switching-sdk-samples](https://gitlab.com/verenigingcoin-public/coin-sdk-php/tree/master/bundle-switching-sdk-samples) directory.


## Configure Credentials

For secure access credentials are required.
- Check [this README](https://gitlab.com/verenigingcoin-public/consumer-configuration/-/blob/master/README.md) to find out how to configure these.
- In summary, you will need:
    - a consumer name
    - a private key file
    - a file containing the encrypted Hmac secret
    - the base url of the Coin platform you are using
- These can be used to create instances of the `BundleSwitchingService` and the `BundleSwitchingMessageConsumer`.
If you instantiate these without consumer name etc., the required values will be searched in `$_ENV` and subsequently in `$GLOBALS`
under the following names:

| $_ENV                      | $GLOBALS                |
|----------------------------|-------------------------|
| CONSUMER_NAME              | ConsumerName            |
| PRIVATE_KEY_FILE           | PrivateKeyFile          |
| ENCRYPTED_HMAC_SECRET_FILE | EncryptedHmacSecretFile |
| COIN_BASE_URL              | CoinBaseUrl             |

For populating the `$_ENV` variable, [PHP dotenv](https://github.com/vlucas/phpdotenv) could be used.


## Send Messages

The `BundleSwitchingService` has a `sendMessage` method to send any bundle switching message to the API.
The Bundle Switching SDK contains Builders to construct the various messages.

## Consume Messages

### Create Message Listener
For message consumption, the bundle switching API makes use of HTTP's [ServerSentEvents](https://en.wikipedia.org/wiki/Server-sent_events).
The SDK offers a Listener interface `IBundleSwitchingMessageListener` which is triggered upon reception of a message payload.
Whenever the API doesn't send any other message for 20 seconds, it sends an empty 'heartbeat' message, which triggers the onKeepAlive() function.

### Start consuming messages 
The `BundleSwitchingMessageConsumer` has three `consume...()` methods for consuming messages, of which `consumeUnconfirmed()` is most useful.
All these methods need an instance of the `IBundleSwitchingMessageListener`. These methods return a Generator of `message-id`s; iterating over this
Generator causes the messages to be consumed.

### Consume specific messages using filters
The `BundleSwitchingMessageConsumer` provides various filters for message consumption. The filters are:
- `MessageType`: All possible message types, including errors. Use the `MessageType`-enumeration to indicate which messages have to be consumed.
- confirmation status: By using `consumeAll()`, all messages will be received, both confirmed and unconfirmed.   
    **Note:** this enables the consumption of the *whole message history*.
    Therefore, this requires you to supply an implementation of the `IOffsetPersister` interface.
    The purpose of this interface is to track the `message-id` of the last received and processed message.
    In case of a reconnect, message consumption will then resume where it left off.
- `offset`: starts consuming messages based on the given `message-id` offset. ***Note:*** it is the responsibility of the client to keep track of the `offset`.

#### Confirm Messages
Once a consumed message is processed it needs to be confirmed.
To confirm a message use the `BundleSwitchingService.sendConfirmation(id)` method.


## Error Handling

The bundle switching API can return errors in two ways:

1. The server received an incorrect payload and replies with an error response (synchronous)

    The REST layer of the system only performs basic payload checks, such as swagger schema validity and message authorization.
    Any errors in these checks are immediately returned as an error reply.

2. As a ServerSentEvent containing an `ErrorFoundEnvelope` (asynchronous)

    The system performs detailed functional validation asynchronously. Errors in this stage are sent via a `ServerSentEvent`, 
    which will eventually be offered in the `onErrorFound($messageId, ErrorFoundMessage $message)` of the `IBundleSwitchingMessageListener`.

    ***Note:*** `ErrorFound` messages need to be confirmed like any other message received via a `ServerSentEvent`.
