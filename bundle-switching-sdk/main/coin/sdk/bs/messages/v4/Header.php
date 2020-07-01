<?php
/**
 * Header
 *
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * COIN Bundle Switching Rest API
 *
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * Contact: servicedesk@coin.nl
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.14
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace coin\sdk\bs\messages\v4;

use \ArrayAccess;
use InvalidArgumentException;
use coin\sdk\bs\ObjectSerializer;

/**
 * Header Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Header implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Header';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'receiver' => '\coin\sdk\bs\messages\v4\Receiver',
        'sender' => '\coin\sdk\bs\messages\v4\Sender',
        'messageid' => 'string',
        'timestamp' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'receiver' => null,
        'sender' => null,
        'messageid' => null,
        'timestamp' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'receiver' => 'receiver',
        'sender' => 'sender',
        'messageid' => 'messageid',
        'timestamp' => 'timestamp'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'receiver' => 'setReceiver',
        'sender' => 'setSender',
        'messageid' => 'setMessageid',
        'timestamp' => 'setTimestamp'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'receiver' => 'getReceiver',
        'sender' => 'getSender',
        'messageid' => 'getMessageid',
        'timestamp' => 'getTimestamp'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['receiver'] = isset($data['receiver']) ? $data['receiver'] : null;
        $this->container['sender'] = isset($data['sender']) ? $data['sender'] : null;
        $this->container['messageid'] = isset($data['messageid']) ? $data['messageid'] : null;
        $this->container['timestamp'] = isset($data['timestamp']) ? $data['timestamp'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['receiver'] === null) {
            $invalidProperties[] = "'receiver' can't be null";
        }
        if ($this->container['sender'] === null) {
            $invalidProperties[] = "'sender' can't be null";
        }
        if (!is_null($this->container['messageid']) && (mb_strlen($this->container['messageid']) > 26)) {
            $invalidProperties[] = "invalid value for 'messageid', the character length must be smaller than or equal to 26.";
        }

        if (!is_null($this->container['messageid']) && (mb_strlen($this->container['messageid']) < 1)) {
            $invalidProperties[] = "invalid value for 'messageid', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['timestamp'] === null) {
            $invalidProperties[] = "'timestamp' can't be null";
        }
        if (!preg_match("/^\\d{4}-\\d\\d-\\d\\dT\\d\\d:\\d\\d:\\d\\d$/", $this->container['timestamp'])) {
            $invalidProperties[] = "invalid value for 'timestamp', must be conform to the pattern /^\\d{4}-\\d\\d-\\d\\dT\\d\\d:\\d\\d:\\d\\d$/.";
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets receiver
     *
     * @return Receiver
     */
    public function getReceiver()
    {
        return $this->container['receiver'];
    }

    /**
     * Sets receiver
     *
     * @param Receiver $receiver receiver
     *
     * @return $this
     */
    public function setReceiver($receiver)
    {
        $this->container['receiver'] = $receiver;

        return $this;
    }

    /**
     * Gets sender
     *
     * @return Sender
     */
    public function getSender()
    {
        return $this->container['sender'];
    }

    /**
     * Sets sender
     *
     * @param Sender $sender sender
     *
     * @return $this
     */
    public function setSender($sender)
    {
        $this->container['sender'] = $sender;

        return $this;
    }

    /**
     * Gets messageid
     *
     * @return string
     */
    public function getMessageid()
    {
        return $this->container['messageid'];
    }

    /**
     * Sets messageid
     *
     * @param string $messageid Unique technical identifier that is determined by the initiator of the message.
     *
     * @return $this
     */
    public function setMessageid($messageid)
    {
        if (!is_null($messageid) && (mb_strlen($messageid) > 26)) {
            throw new InvalidArgumentException('invalid length for $messageid when calling Header., must be smaller than or equal to 26.');
        }
        if (!is_null($messageid) && (mb_strlen($messageid) < 1)) {
            throw new InvalidArgumentException('invalid length for $messageid when calling Header., must be bigger than or equal to 1.');
        }

        $this->container['messageid'] = $messageid;

        return $this;
    }

    /**
     * Gets timestamp
     *
     * @return string
     */
    public function getTimestamp()
    {
        return $this->container['timestamp'];
    }

    /**
     * Sets timestamp
     *
     * @param string $timestamp Datetimestamp of the moment the message has been created. Format: CCYY-MM-DDTHH24:MI:SS
     *
     * @return $this
     */
    public function setTimestamp($timestamp)
    {

        if ((!preg_match("/^\\d{4}-\\d\\d-\\d\\dT\\d\\d:\\d\\d:\\d\\d$/", $timestamp))) {
            throw new InvalidArgumentException("invalid value for $timestamp when calling Header., must conform to the pattern /^\\d{4}-\\d\\d-\\d\\dT\\d\\d:\\d\\d:\\d\\d$/.");
        }

        $this->container['timestamp'] = $timestamp;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


