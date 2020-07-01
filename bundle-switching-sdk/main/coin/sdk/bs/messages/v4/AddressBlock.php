<?php
/**
 * AddressBlock
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
use \Swagger\Client\ObjectSerializer;

/**
 * AddressBlock Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class AddressBlock implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'AddressBlock';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'postcode' => 'string',
        'housenr' => 'string',
        'housenr_ext' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'postcode' => null,
        'housenr' => null,
        'housenr_ext' => null
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
        'postcode' => 'postcode',
        'housenr' => 'housenr',
        'housenr_ext' => 'housenr_ext'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'postcode' => 'setPostcode',
        'housenr' => 'setHousenr',
        'housenr_ext' => 'setHousenrExt'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'postcode' => 'getPostcode',
        'housenr' => 'getHousenr',
        'housenr_ext' => 'getHousenrExt'
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
        $this->container['postcode'] = isset($data['postcode']) ? $data['postcode'] : null;
        $this->container['housenr'] = isset($data['housenr']) ? $data['housenr'] : null;
        $this->container['housenr_ext'] = isset($data['housenr_ext']) ? $data['housenr_ext'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['postcode'] === null) {
            $invalidProperties[] = "'postcode' can't be null";
        }
        if (!preg_match("/^[1-9]\\d{3}[A-Z]{2}$/", $this->container['postcode'])) {
            $invalidProperties[] = "invalid value for 'postcode', must be conform to the pattern /^[1-9]\\d{3}[A-Z]{2}$/.";
        }

        if ($this->container['housenr'] === null) {
            $invalidProperties[] = "'housenr' can't be null";
        }
        if (!preg_match("/^\\d{1,5}$/", $this->container['housenr'])) {
            $invalidProperties[] = "invalid value for 'housenr', must be conform to the pattern /^\\d{1,5}$/.";
        }

        if (!is_null($this->container['housenr_ext']) && (mb_strlen($this->container['housenr_ext']) > 6)) {
            $invalidProperties[] = "invalid value for 'housenr_ext', the character length must be smaller than or equal to 6.";
        }

        if (!is_null($this->container['housenr_ext']) && (mb_strlen($this->container['housenr_ext']) < 1)) {
            $invalidProperties[] = "invalid value for 'housenr_ext', the character length must be bigger than or equal to 1.";
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
     * Gets postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->container['postcode'];
    }

    /**
     * Sets postcode
     *
     * @param string $postcode Contract Postcode, that is requested to be terminated
     *
     * @return $this
     */
    public function setPostcode($postcode)
    {

        if ((!preg_match("/^[1-9]\\d{3}[A-Z]{2}$/", $postcode))) {
            throw new InvalidArgumentException("invalid value for $postcode when calling AddressBlock., must conform to the pattern /^[1-9]\\d{3}[A-Z]{2}$/.");
        }

        $this->container['postcode'] = $postcode;

        return $this;
    }

    /**
     * Gets housenr
     *
     * @return string
     */
    public function getHousenr()
    {
        return $this->container['housenr'];
    }

    /**
     * Sets housenr
     *
     * @param string $housenr Contract House number that is requested to be terminated
     *
     * @return $this
     */
    public function setHousenr($housenr)
    {

        if ((!preg_match("/^\\d{1,5}$/", $housenr))) {
            throw new InvalidArgumentException("invalid value for $housenr when calling AddressBlock., must conform to the pattern /^\\d{1,5}$/.");
        }

        $this->container['housenr'] = $housenr;

        return $this;
    }

    /**
     * Gets housenr_ext
     *
     * @return string
     */
    public function getHousenrExt()
    {
        return $this->container['housenr_ext'];
    }

    /**
     * Sets housenr_ext
     *
     * @param string $housenr_ext Contract House number that is requested to be terminated
     *
     * @return $this
     */
    public function setHousenrExt($housenr_ext)
    {
        if (!is_null($housenr_ext) && (mb_strlen($housenr_ext) > 6)) {
            throw new InvalidArgumentException('invalid length for $housenr_ext when calling AddressBlock., must be smaller than or equal to 6.');
        }
        if (!is_null($housenr_ext) && (mb_strlen($housenr_ext) < 1)) {
            throw new InvalidArgumentException('invalid length for $housenr_ext when calling AddressBlock., must be bigger than or equal to 1.');
        }

        $this->container['housenr_ext'] = $housenr_ext;

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


