<?php

namespace coin\sdk\bs\messages\v5\common;

use coin\sdk\bs\ObjectSerializer;

abstract class MessageType
{
    const CANCEL = "cancel";
    const CONTRACT_TERMINATION_PERFORMED = "contractterminationperformed";
    const CONTRACT_TERMINATION_REQUEST = "contractterminationrequest";
    const CONTRACT_TERMINATION_REQUEST_ANSWER = "contractterminationrequestanswer";
}

class Message {

    private $message;
    private $messageType;

    /**
     * Array of property to type mappings. Used for (de)serialization
     * @var string[]
     */
    protected static $swaggerTypes = [
        'message' => '\coin\sdk\bs\messages\v5\CancelMessage'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     * @var string[]
     */
    protected static $swaggerFormats = [
        'message' => null
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'message' => 'message'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'message' => 'setMessage'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'message' => 'getMessage'
    ];

    public static function setters()
    {
        return self::$setters;
    }

    public static function getters()
    {
        return self::$getters;
    }

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function getMessageType()
    {
        return $this->messageType;
    }


    public function __construct($message, $messageType)
    {
        $this->message = $message;
        $this->messageType = $messageType;
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }

}
