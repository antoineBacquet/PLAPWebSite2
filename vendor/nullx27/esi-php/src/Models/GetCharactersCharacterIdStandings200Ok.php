<?php
/**
 * GetCharactersCharacterIdStandings200Ok
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
 * GetCharactersCharacterIdStandings200Ok Class Doc Comment
 *
 * @category    Class */
 // @description 200 ok object
/**
 * @package     nullx27\ESI
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class GetCharactersCharacterIdStandings200Ok implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'get_characters_character_id_standings_200_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'fromId' => 'int',
        'fromType' => 'string',
        'standing' => 'float'
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
        'fromId' => 'from_id',
        'fromType' => 'from_type',
        'standing' => 'standing'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'fromId' => 'setFromId',
        'fromType' => 'setFromType',
        'standing' => 'setStanding'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'fromId' => 'getFromId',
        'fromType' => 'getFromType',
        'standing' => 'getStanding'
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

    const FROM_TYPE_AGENT = 'agent';
    const FROM_TYPE_NPC_CORP = 'npc_corp';
    const FROM_TYPE_FACTION = 'faction';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getFromTypeAllowableValues()
    {
        return [
            self::FROM_TYPE_AGENT,
            self::FROM_TYPE_NPC_CORP,
            self::FROM_TYPE_FACTION,
        ];
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
        $this->container['fromId'] = isset($data['fromId']) ? $data['fromId'] : null;
        $this->container['fromType'] = isset($data['fromType']) ? $data['fromType'] : null;
        $this->container['standing'] = isset($data['standing']) ? $data['standing'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        if ($this->container['fromId'] === null) {
            $invalid_properties[] = "'fromId' can't be null";
        }
        if ($this->container['fromType'] === null) {
            $invalid_properties[] = "'fromType' can't be null";
        }
        $allowed_values = ["agent", "npc_corp", "faction"];
        if (!in_array($this->container['fromType'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'fromType', must be one of #{allowed_values}.";
        }

        if ($this->container['standing'] === null) {
            $invalid_properties[] = "'standing' can't be null";
        }
        if (($this->container['standing'] > 10)) {
            $invalid_properties[] = "invalid value for 'standing', must be smaller than or equal to 10.";
        }

        if (($this->container['standing'] < -10)) {
            $invalid_properties[] = "invalid value for 'standing', must be bigger than or equal to -10.";
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
        if ($this->container['fromId'] === null) {
            return false;
        }
        if ($this->container['fromType'] === null) {
            return false;
        }
        $allowed_values = ["agent", "npc_corp", "faction"];
        if (!in_array($this->container['fromType'], $allowed_values)) {
            return false;
        }
        if ($this->container['standing'] === null) {
            return false;
        }
        if ($this->container['standing'] > 10) {
            return false;
        }
        if ($this->container['standing'] < -10) {
            return false;
        }
        return true;
    }


    /**
     * Gets fromId
     * @return int
     */
    public function getFromId()
    {
        return $this->container['fromId'];
    }

    /**
     * Sets fromId
     * @param int $fromId from_id integer
     * @return $this
     */
    public function setFromId($fromId)
    {
        $this->container['fromId'] = $fromId;

        return $this;
    }

    /**
     * Gets fromType
     * @return string
     */
    public function getFromType()
    {
        return $this->container['fromType'];
    }

    /**
     * Sets fromType
     * @param string $fromType from_type string
     * @return $this
     */
    public function setFromType($fromType)
    {
        $allowed_values = array('agent', 'npc_corp', 'faction');
        if ((!in_array($fromType, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'fromType', must be one of 'agent', 'npc_corp', 'faction'");
        }
        $this->container['fromType'] = $fromType;

        return $this;
    }

    /**
     * Gets standing
     * @return float
     */
    public function getStanding()
    {
        return $this->container['standing'];
    }

    /**
     * Sets standing
     * @param float $standing standing number
     * @return $this
     */
    public function setStanding($standing)
    {

        if (($standing > 10)) {
            throw new \InvalidArgumentException('invalid value for $standing when calling GetCharactersCharacterIdStandings200Ok., must be smaller than or equal to 10.');
        }
        if (($standing < -10)) {
            throw new \InvalidArgumentException('invalid value for $standing when calling GetCharactersCharacterIdStandings200Ok., must be bigger than or equal to -10.');
        }

        $this->container['standing'] = $standing;

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


