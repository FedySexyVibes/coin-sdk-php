<?php
/**
 * PortingRequestAnswerSeq
 *
 * PHP version 5
 *
 * @category Class
 * @package  coin\sdk\np
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * COIN CRDB Rest API
 *
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * Contact: devops@coin.nl
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 3.0.8
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace coin\sdk\np\messages\v1;

use \ArrayAccess;
use \coin\sdk\np\ObjectSerializer;

/**
 * PortingRequestAnswerSeq Class Doc Comment
 *
 * @category Class
 * @package  coin\sdk\np
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PortingRequestAnswerSeq implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'PortingRequestAnswerSeq';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'numberseries' => '\coin\sdk\np\messages\v1\NumberSeries',
'blockingcode' => 'string',
'firstpossibledate' => 'string',
'note' => 'string',
'donornetworkoperator' => 'string',
'donorserviceprovider' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'numberseries' => null,
'blockingcode' => null,
'firstpossibledate' => null,
'note' => null,
'donornetworkoperator' => null,
'donorserviceprovider' => null    ];

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
        'numberseries' => 'numberseries',
'blockingcode' => 'blockingcode',
'firstpossibledate' => 'firstpossibledate',
'note' => 'note',
'donornetworkoperator' => 'donornetworkoperator',
'donorserviceprovider' => 'donorserviceprovider'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'numberseries' => 'setNumberseries',
'blockingcode' => 'setBlockingcode',
'firstpossibledate' => 'setFirstpossibledate',
'note' => 'setNote',
'donornetworkoperator' => 'setDonornetworkoperator',
'donorserviceprovider' => 'setDonorserviceprovider'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'numberseries' => 'getNumberseries',
'blockingcode' => 'getBlockingcode',
'firstpossibledate' => 'getFirstpossibledate',
'note' => 'getNote',
'donornetworkoperator' => 'getDonornetworkoperator',
'donorserviceprovider' => 'getDonorserviceprovider'    ];

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
        $this->container['numberseries'] = isset($data['numberseries']) ? $data['numberseries'] : null;
        $this->container['blockingcode'] = isset($data['blockingcode']) ? $data['blockingcode'] : null;
        $this->container['firstpossibledate'] = isset($data['firstpossibledate']) ? $data['firstpossibledate'] : null;
        $this->container['note'] = isset($data['note']) ? $data['note'] : null;
        $this->container['donornetworkoperator'] = isset($data['donornetworkoperator']) ? $data['donornetworkoperator'] : null;
        $this->container['donorserviceprovider'] = isset($data['donorserviceprovider']) ? $data['donorserviceprovider'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['numberseries'] === null) {
            $invalidProperties[] = "'numberseries' can't be null";
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
     * Gets numberseries
     *
     * @return NumberSeries
     */
    public function getNumberseries()
    {
        return $this->container['numberseries'];
    }

    /**
     * Sets numberseries
     *
     * @param NumberSeries $numberseries numberseries
     *
     * @return $this
     */
    public function setNumberseries($numberseries)
    {
        $this->container['numberseries'] = $numberseries;

        return $this;
    }

    /**
     * Gets blockingcode
     *
     * @return string
     */
    public function getBlockingcode()
    {
        return $this->container['blockingcode'];
    }

    /**
     * Sets blockingcode
     *
     * @param string $blockingcode blockingcode
     *
     * @return $this
     */
    public function setBlockingcode($blockingcode)
    {
        $this->container['blockingcode'] = $blockingcode;

        return $this;
    }

    /**
     * Gets firstpossibledate
     *
     * @return string
     */
    public function getFirstpossibledate()
    {
        return $this->container['firstpossibledate'];
    }

    /**
     * Sets firstpossibledate
     *
     * @param string $firstpossibledate firstpossibledate
     *
     * @return $this
     */
    public function setFirstpossibledate($firstpossibledate)
    {
        $this->container['firstpossibledate'] = $firstpossibledate;

        return $this;
    }

    /**
     * Gets note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->container['note'];
    }

    /**
     * Sets note
     *
     * @param string $note note
     *
     * @return $this
     */
    public function setNote($note)
    {
        $this->container['note'] = $note;

        return $this;
    }

    /**
     * Gets donornetworkoperator
     *
     * @return string
     */
    public function getDonornetworkoperator()
    {
        return $this->container['donornetworkoperator'];
    }

    /**
     * Sets donornetworkoperator
     *
     * @param string $donornetworkoperator donornetworkoperator
     *
     * @return $this
     */
    public function setDonornetworkoperator($donornetworkoperator)
    {
        $this->container['donornetworkoperator'] = $donornetworkoperator;

        return $this;
    }

    /**
     * Gets donorserviceprovider
     *
     * @return string
     */
    public function getDonorserviceprovider()
    {
        return $this->container['donorserviceprovider'];
    }

    /**
     * Sets donorserviceprovider
     *
     * @param string $donorserviceprovider donorserviceprovider
     *
     * @return $this
     */
    public function setDonorserviceprovider($donorserviceprovider)
    {
        $this->container['donorserviceprovider'] = $donorserviceprovider;

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
