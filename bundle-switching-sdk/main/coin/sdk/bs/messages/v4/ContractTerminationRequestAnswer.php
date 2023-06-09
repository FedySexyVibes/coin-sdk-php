<?php
/**
 * ContractTerminationRequestAnswer
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

namespace coin\sdk\bs\messages\v5;

use \ArrayAccess;
use coin\sdk\bs\ObjectSerializer;
use InvalidArgumentException;

/**
 * ContractTerminationRequestAnswer Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ContractTerminationRequestAnswer implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ContractTerminationRequestAnswer';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'dossierid' => 'string',
        'blocking' => 'string',
        'blockingcode' => 'string',
        'firstpossibledate' => 'string',
        'infrablock' => '\coin\sdk\bs\messages\v5\InfraBlock',
        'note' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'dossierid' => null,
        'blocking' => null,
        'blockingcode' => null,
        'firstpossibledate' => null,
        'infrablock' => null,
        'note' => null
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
        'dossierid' => 'dossierid',
        'blocking' => 'blocking',
        'blockingcode' => 'blockingcode',
        'firstpossibledate' => 'firstpossibledate',
        'infrablock' => 'infrablock',
        'note' => 'note'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'dossierid' => 'setDossierid',
        'blocking' => 'setBlocking',
        'blockingcode' => 'setBlockingcode',
        'firstpossibledate' => 'setFirstpossibledate',
        'infrablock' => 'setInfrablock',
        'note' => 'setNote'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'dossierid' => 'getDossierid',
        'blocking' => 'getBlocking',
        'blockingcode' => 'getBlockingcode',
        'firstpossibledate' => 'getFirstpossibledate',
        'infrablock' => 'getInfrablock',
        'note' => 'getNote'
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
        $this->container['dossierid'] = isset($data['dossierid']) ? $data['dossierid'] : null;
        $this->container['blocking'] = isset($data['blocking']) ? $data['blocking'] : null;
        $this->container['blockingcode'] = isset($data['blockingcode']) ? $data['blockingcode'] : null;
        $this->container['firstpossibledate'] = isset($data['firstpossibledate']) ? $data['firstpossibledate'] : null;
        $this->container['infrablock'] = isset($data['infrablock']) ? $data['infrablock'] : null;
        $this->container['note'] = isset($data['note']) ? $data['note'] : null;
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
        if ((mb_strlen($this->container['dossierid']) > 40)) {
            $invalidProperties[] = "invalid value for 'dossierid', the character length must be smaller than or equal to 40.";
        }

        if ((mb_strlen($this->container['dossierid']) < 8)) {
            $invalidProperties[] = "invalid value for 'dossierid', the character length must be bigger than or equal to 8.";
        }

        if (!preg_match("/^[A-Z0-9]{1,6}-[A-Z0-9]{1,6}-[A-Za-z0-9]{1,22}-[0-9]{1,3}$/", $this->container['dossierid'])) {
            $invalidProperties[] = "invalid value for 'dossierid', must be conform to the pattern /^[A-Z0-9]{1,6}-[A-Z0-9]{1,6}-[A-Za-z0-9]{1,22}-[0-9]{1,3}$/.";
        }

        if ($this->container['blocking'] === null) {
            $invalidProperties[] = "'blocking' can't be null";
        }
        if (!preg_match("/^[YN]$/", $this->container['blocking'])) {
            $invalidProperties[] = "invalid value for 'blocking', must be conform to the pattern /^[YN]$/.";
        }

        if (!is_null($this->container['blockingcode']) && !preg_match("/[1-9]{0,1}[0-9]/", $this->container['blockingcode'])) {
            $invalidProperties[] = "invalid value for 'blockingcode', must be conform to the pattern /[1-9]{0,1}[0-9]/.";
        }

        if (!is_null($this->container['firstpossibledate']) && !preg_match("/^\\d{4}-\\d\\d-\\d\\dT\\d\\d:\\d\\d:\\d\\d$/", $this->container['firstpossibledate'])) {
            $invalidProperties[] = "invalid value for 'firstpossibledate', must be conform to the pattern /^\\d{4}-\\d\\d-\\d\\dT\\d\\d:\\d\\d:\\d\\d$/.";
        }

        if (!is_null($this->container['note']) && (mb_strlen($this->container['note']) > 100)) {
            $invalidProperties[] = "invalid value for 'note', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['note']) && (mb_strlen($this->container['note']) < 1)) {
            $invalidProperties[] = "invalid value for 'note', the character length must be bigger than or equal to 1.";
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
     * @param string $dossierid The identifier for the Contract Termination Request determined by the Recipient for communication between the Recipient and Donor. Defined as [RecipientSPCode]-[DonorSPCode]-[Identifier] The requirement is that the dossierid is unique and identifies the contract termination request.
     *
     * @return $this
     */
    public function setDossierid($dossierid)
    {
        if ((mb_strlen($dossierid) > 40)) {
            throw new InvalidArgumentException('invalid length for $dossierid when calling ContractTerminationRequestAnswer., must be smaller than or equal to 40.');
        }
        if ((mb_strlen($dossierid) < 8)) {
            throw new InvalidArgumentException('invalid length for $dossierid when calling ContractTerminationRequestAnswer., must be bigger than or equal to 8.');
        }
        if ((!preg_match("/^[A-Z0-9]{1,6}-[A-Z0-9]{1,6}-[A-Za-z0-9]{1,22}-[0-9]{1,3}$/", $dossierid))) {
            throw new InvalidArgumentException("invalid value for $dossierid when calling ContractTerminationRequestAnswer., must conform to the pattern /^[A-Z0-9]{1,6}-[A-Z0-9]{1,6}-[A-Za-z0-9]{1,22}-[0-9]{1,3}$/.");
        }

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
     * @param string $blocking Blocking indicator as a response to the contract termination request message.
     *
     * @return $this
     */
    public function setBlocking($blocking)
    {

        if ((!preg_match("/^[YN]$/", $blocking))) {
            throw new InvalidArgumentException("invalid value for $blocking when calling ContractTerminationRequestAnswer., must conform to the pattern /^[YN]$/.");
        }

        $this->container['blocking'] = $blocking;

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
     * @param string $blockingcode Blocking code as described in E2E Overstappen. If blockingcode = 0 then blocking=N else blocking=Y
     *
     * @return $this
     */
    public function setBlockingcode($blockingcode)
    {

        if (!is_null($blockingcode) && (!preg_match("/[1-9]{0,1}[0-9]/", $blockingcode))) {
            throw new InvalidArgumentException("invalid value for $blockingcode when calling ContractTerminationRequestAnswer., must conform to the pattern /[1-9]{0,1}[0-9]/.");
        }

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
     * @param string $firstpossibledate The first possible date that the contract termination can take place. Format: CCYY-MM-DDTHH24:MI:SS
     *
     * @return $this
     */
    public function setFirstpossibledate($firstpossibledate)
    {

        if (!is_null($firstpossibledate) && (!preg_match("/^\\d{4}-\\d\\d-\\d\\dT\\d\\d:\\d\\d:\\d\\d$/", $firstpossibledate))) {
            throw new InvalidArgumentException("invalid value for $firstpossibledate when calling ContractTerminationRequestAnswer., must conform to the pattern /^\\d{4}-\\d\\d-\\d\\dT\\d\\d:\\d\\d:\\d\\d$/.");
        }

        $this->container['firstpossibledate'] = $firstpossibledate;

        return $this;
    }

    /**
     * Gets infrablock
     *
     * @return InfraBlock
     */
    public function getInfrablock()
    {
        return $this->container['infrablock'];
    }

    /**
     * Sets infrablock
     *
     * @param InfraBlock $infrablock infrablock
     *
     * @return $this
     */
    public function setInfrablock($infrablock)
    {
        $this->container['infrablock'] = $infrablock;

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
     * @param string $note Note field for additional information
     *
     * @return $this
     */
    public function setNote($note)
    {
        if (!is_null($note) && (mb_strlen($note) > 100)) {
            throw new InvalidArgumentException('invalid length for $note when calling ContractTerminationRequestAnswer., must be smaller than or equal to 100.');
        }
        if (!is_null($note) && (mb_strlen($note) < 1)) {
            throw new InvalidArgumentException('invalid length for $note when calling ContractTerminationRequestAnswer., must be bigger than or equal to 1.');
        }

        $this->container['note'] = $note;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists(mixed $offset): bool
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
    public function offsetGet(mixed $offset): mixed
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
    public function offsetSet(mixed $offset, mixed $value): void
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
    public function offsetUnset(mixed $offset): void
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


