<?php

namespace coin\sdk\np\messages\v1\common;

use coin\sdk\np\ObjectSerializer;

abstract class MessageType
{
    const ACTIVATION_SERVICE_NUMBER = "activationsn";
    const CANCEL = "cancel";
    const CONFIRMATION = "confirmations";
    const DEACTIVATION = "deactivation";
    const DEACTIVATION_SERVICE_NUMBER = "deactivationsn";
    const ENUM_ACTIVATION_NUMBER = "enumactivationnumber";
    const ENUM_ACTIVATION_OPERATOR = "enumactivationoperator";
    const ENUM_ACTIVATION_RANGE = "enumactivationrange";
    const ENUM_DEACTIVATION_NUMBER = "enumdeactivationnumber";
    const ENUM_DEACTIVATION_OPERATOR = "enumdeactivationoperator";
    const ENUM_DEACTIVATION_RANGE = "enumdeactivationrange";
    const ENUM_PROFILE_ACTIVATION = "enumprofileactivation";
    const ENUM_PROFILE_DEACTIVATION = "enumprofiledeactivation";
    const ERROR_FOUND = "errorfound";
    const PORTING_PERFORMED = "portingperformed";
    const PORTING_REQUEST = "portingrequest";
    const PORTING_REQUEST_ANSWER = "portingrequestanswer";
    const PORTING_REQUEST_ANSWER_DELAYED = "pradelayed";
    const RANGE_ACTIVATION = "rangeactivation";
    const RANGE_DEACTIVATION = "rangedeactivation";
    const TARIFF_CHANGE_SERVICE_NUMNER = "tariffchangesn";
}

class Message {

    private $message;
    private $messageType;

    /**
     * Array of property to type mappings. Used for (de)serialization
     * @var string[]
     */
    protected static $swaggerTypes = [
        'message' => '\Swagger\Client\Model\CancelMessage'
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
