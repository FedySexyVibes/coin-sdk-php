<?php
/**
 * PortingRequestAnswer
 *
 * PHP version 5
 *
 * @category Class
 * @package  coin\sdk\np\messages\v3
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * COIN Number Portability API V3
 *
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 3.0.0
 * Contact: servicedesk@coin.nl
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 3.0.25
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace coin\sdk\np\messages\v3\model;

use \ArrayAccess;
use \coin\sdk\np\messages\v3\ObjectSerializer;

/**
 * PortingRequestAnswer Class Doc Comment
 *
 * @category Class
 * @package  coin\sdk\np\messages\v3
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PortingRequestAnswer implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'PortingRequestAnswer';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'dossierid' => 'string',
'blocking' => 'string',
'repeats' => '\coin\sdk\np\messages\v3\model\PortingRequestAnswerRepeats[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'dossierid' => null,
'blocking' => null,
'repeats' => null    ];

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
        'dossierid' => 'dossierid',
'blocking' => 'blocking',
'repeats' => 'repeats'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'dossierid' => 'setDossierid',
'blocking' => 'setBlocking',
'repeats' => 'setRepeats'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'dossierid' => 'getDossierid',
'blocking' => 'getBlocking',
'repeats' => 'getRepeats'    ];

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
        $this->container['dossierid'] = isset($data['dossierid']) ? $data['dossierid'] : null;
        $this->container['blocking'] = isset($data['blocking']) ? $data['blocking'] : null;
        $this->container['repeats'] = isset($data['repeats']) ? $data['repeats'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['dossierid'] === null) {
            $invalidProperties[] = "'dossierid' can't be null";
        }
        if ($this->container['blocking'] === null) {
            $invalidProperties[] = "'blocking' can't be null";
        }
        if ($this->container['repeats'] === null) {
            $invalidProperties[] = "'repeats' can't be null";
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
     * Gets dossierid
     *
     * @return string
     */
    public function getDossierid()
    {
        return $this->container['dossierid'];
    }

    /**
     * Sets dossierid
     *
     * @param string $dossierid dossierid
     *
     * @return $this
     */
    public function setDossierid($dossierid)
    {
        $this->container['dossierid'] = $dossierid;

        return $this;
    }

    /**
     * Gets blocking
     *
     * @return string
     */
    public function getBlocking()
    {
        return $this->container['blocking'];
    }

    /**
     * Sets blocking
     *
     * @param string $blocking blocking
     *
     * @return $this
     */
    public function setBlocking($blocking)
    {
        $this->container['blocking'] = $blocking;

        return $this;
    }

    /**
     * Gets repeats
     *
     * @return \coin\sdk\np\messages\v3\model\PortingRequestAnswerRepeats[]
     */
    public function getRepeats()
    {
        return $this->container['repeats'];
    }

    /**
     * Sets repeats
     *
     * @param \coin\sdk\np\messages\v3\model\PortingRequestAnswerRepeats[] $repeats repeats
     *
     * @return $this
     */
    public function setRepeats($repeats)
    {
        $this->container['repeats'] = $repeats;

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