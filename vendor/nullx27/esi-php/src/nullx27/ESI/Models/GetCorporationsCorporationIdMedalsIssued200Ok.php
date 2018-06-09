<?php
/**
 * GetCorporationsCorporationIdMedalsIssued200Ok
 *
 * PHP version 5
 *
 * @category Class
 * @package  nullx27\ESI
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * EVE Swagger Interface
 *
 * An OpenAPI for EVE Online
 *
 * OpenAPI spec version: 0.7.3
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.3.1-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace nullx27\ESI\nullx27\ESI\Models;

use \ArrayAccess;
use \nullx27\ESI\ObjectSerializer;

/**
 * GetCorporationsCorporationIdMedalsIssued200Ok Class Doc Comment
 *
 * @category Class
 * @description 200 ok object
 * @package  nullx27\ESI
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class GetCorporationsCorporationIdMedalsIssued200Ok implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'get_corporations_corporation_id_medals_issued_200_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'medalId' => 'int',
        'characterId' => 'int',
        'reason' => 'string',
        'status' => 'string',
        'issuerId' => 'int',
        'issuedAt' => '\DateTime'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'medalId' => 'int32',
        'characterId' => 'int32',
        'reason' => null,
        'status' => null,
        'issuerId' => 'int32',
        'issuedAt' => 'date-time'
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
        'medalId' => 'medal_id',
        'characterId' => 'character_id',
        'reason' => 'reason',
        'status' => 'status',
        'issuerId' => 'issuer_id',
        'issuedAt' => 'issued_at'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'medalId' => 'setMedalId',
        'characterId' => 'setCharacterId',
        'reason' => 'setReason',
        'status' => 'setStatus',
        'issuerId' => 'setIssuerId',
        'issuedAt' => 'setIssuedAt'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'medalId' => 'getMedalId',
        'characterId' => 'getCharacterId',
        'reason' => 'getReason',
        'status' => 'getStatus',
        'issuerId' => 'getIssuerId',
        'issuedAt' => 'getIssuedAt'
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

    const STATUS__PRIVATE = 'private';
    const STATUS__PUBLIC = 'public';
    

    
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS__PRIVATE,
            self::STATUS__PUBLIC,
        ];
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
        $this->container['medalId'] = isset($data['medalId']) ? $data['medalId'] : null;
        $this->container['characterId'] = isset($data['characterId']) ? $data['characterId'] : null;
        $this->container['reason'] = isset($data['reason']) ? $data['reason'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['issuerId'] = isset($data['issuerId']) ? $data['issuerId'] : null;
        $this->container['issuedAt'] = isset($data['issuedAt']) ? $data['issuedAt'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['medalId'] === null) {
            $invalidProperties[] = "'medalId' can't be null";
        }
        if ($this->container['characterId'] === null) {
            $invalidProperties[] = "'characterId' can't be null";
        }
        if ($this->container['reason'] === null) {
            $invalidProperties[] = "'reason' can't be null";
        }
        if ((strlen($this->container['reason']) > 1000)) {
            $invalidProperties[] = "invalid value for 'reason', the character length must be smaller than or equal to 1000.";
        }

        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($this->container['status'], $allowedValues)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'status', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['issuerId'] === null) {
            $invalidProperties[] = "'issuerId' can't be null";
        }
        if ($this->container['issuedAt'] === null) {
            $invalidProperties[] = "'issuedAt' can't be null";
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

        if ($this->container['medalId'] === null) {
            return false;
        }
        if ($this->container['characterId'] === null) {
            return false;
        }
        if ($this->container['reason'] === null) {
            return false;
        }
        if (strlen($this->container['reason']) > 1000) {
            return false;
        }
        if ($this->container['status'] === null) {
            return false;
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($this->container['status'], $allowedValues)) {
            return false;
        }
        if ($this->container['issuerId'] === null) {
            return false;
        }
        if ($this->container['issuedAt'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets medalId
     *
     * @return int
     */
    public function getMedalId()
    {
        return $this->container['medalId'];
    }

    /**
     * Sets medalId
     *
     * @param int $medalId medal_id integer
     *
     * @return $this
     */
    public function setMedalId($medalId)
    {
        $this->container['medalId'] = $medalId;

        return $this;
    }

    /**
     * Gets characterId
     *
     * @return int
     */
    public function getCharacterId()
    {
        return $this->container['characterId'];
    }

    /**
     * Sets characterId
     *
     * @param int $characterId ID of the character who was rewarded this medal
     *
     * @return $this
     */
    public function setCharacterId($characterId)
    {
        $this->container['characterId'] = $characterId;

        return $this;
    }

    /**
     * Gets reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->container['reason'];
    }

    /**
     * Sets reason
     *
     * @param string $reason reason string
     *
     * @return $this
     */
    public function setReason($reason)
    {
        if ((strlen($reason) > 1000)) {
            throw new \InvalidArgumentException('invalid length for $reason when calling GetCorporationsCorporationIdMedalsIssued200Ok., must be smaller than or equal to 1000.');
        }

        $this->container['reason'] = $reason;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status status string
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets issuerId
     *
     * @return int
     */
    public function getIssuerId()
    {
        return $this->container['issuerId'];
    }

    /**
     * Sets issuerId
     *
     * @param int $issuerId ID of the character who issued the medal
     *
     * @return $this
     */
    public function setIssuerId($issuerId)
    {
        $this->container['issuerId'] = $issuerId;

        return $this;
    }

    /**
     * Gets issuedAt
     *
     * @return \DateTime
     */
    public function getIssuedAt()
    {
        return $this->container['issuedAt'];
    }

    /**
     * Sets issuedAt
     *
     * @param \DateTime $issuedAt issued_at string
     *
     * @return $this
     */
    public function setIssuedAt($issuedAt)
    {
        $this->container['issuedAt'] = $issuedAt;

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


