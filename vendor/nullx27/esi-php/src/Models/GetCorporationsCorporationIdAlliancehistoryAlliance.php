<?php
/**
 * GetCorporationsCorporationIdAlliancehistoryAlliance
 *
 * PHP version 5
 *
 * @category Class
 * @package  nullx27\ESI
 * @author   Swaagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * EVE Swagger Interface
 *
 * An OpenAPI for EVE Online
 *
 * OpenAPI spec version: 0.4.9.dev1
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace nullx27\ESI\Models;

use \ArrayAccess;

/**
 * GetCorporationsCorporationIdAlliancehistoryAlliance Class Doc Comment
 *
 * @category    Class */
 // @description alliance object
/**
 * @package     nullx27\ESI
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class GetCorporationsCorporationIdAlliancehistoryAlliance implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'get_corporations_corporation_id_alliancehistory_alliance';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'allianceId' => 'int',
        'isDeleted' => 'bool'
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'allianceId' => 'alliance_id',
        'isDeleted' => 'is_deleted'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'allianceId' => 'setAllianceId',
        'isDeleted' => 'setIsDeleted'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'allianceId' => 'getAllianceId',
        'isDeleted' => 'getIsDeleted'
    ];

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    public static function setters()
    {
        return self::$setters;
    }

    public static function getters()
    {
        return self::$getters;
    }

    

    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['allianceId'] = isset($data['allianceId']) ? $data['allianceId'] : null;
        $this->container['isDeleted'] = isset($data['isDeleted']) ? $data['isDeleted'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        if ($this->container['allianceId'] === null) {
            $invalid_properties[] = "'allianceId' can't be null";
        }
        if ($this->container['isDeleted'] === null) {
            $invalid_properties[] = "'isDeleted' can't be null";
        }
        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properteis are valid
     */
    public function valid()
    {
        if ($this->container['allianceId'] === null) {
            return false;
        }
        if ($this->container['isDeleted'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets allianceId
     * @return int
     */
    public function getAllianceId()
    {
        return $this->container['allianceId'];
    }

    /**
     * Sets allianceId
     * @param int $allianceId alliance_id integer
     * @return $this
     */
    public function setAllianceId($allianceId)
    {
        $this->container['allianceId'] = $allianceId;

        return $this;
    }

    /**
     * Gets isDeleted
     * @return bool
     */
    public function getIsDeleted()
    {
        return $this->container['isDeleted'];
    }

    /**
     * Sets isDeleted
     * @param bool $isDeleted True if the alliance has been deleted
     * @return $this
     */
    public function setIsDeleted($isDeleted)
    {
        $this->container['isDeleted'] = $isDeleted;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
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
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\nullx27\ESI\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\nullx27\ESI\ObjectSerializer::sanitizeForSerialization($this));
    }
}


