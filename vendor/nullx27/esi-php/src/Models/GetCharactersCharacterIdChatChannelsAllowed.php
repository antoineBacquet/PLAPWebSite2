<?php
/**
 * GetCharactersCharacterIdChatChannelsAllowed
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
 * GetCharactersCharacterIdChatChannelsAllowed Class Doc Comment
 *
 * @category    Class */
 // @description allowed object
/**
 * @package     nullx27\ESI
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class GetCharactersCharacterIdChatChannelsAllowed implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'get_characters_character_id_chat_channels_allowed';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'accessorId' => 'int',
        'accessorType' => 'string'
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
        'accessorId' => 'accessor_id',
        'accessorType' => 'accessor_type'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'accessorId' => 'setAccessorId',
        'accessorType' => 'setAccessorType'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'accessorId' => 'getAccessorId',
        'accessorType' => 'getAccessorType'
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

    const ACCESSOR_TYPE_CHARACTER = 'character';
    const ACCESSOR_TYPE_CORPORATION = 'corporation';
    const ACCESSOR_TYPE_ALLIANCE = 'alliance';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getAccessorTypeAllowableValues()
    {
        return [
            self::ACCESSOR_TYPE_CHARACTER,
            self::ACCESSOR_TYPE_CORPORATION,
            self::ACCESSOR_TYPE_ALLIANCE,
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
        $this->container['accessorId'] = isset($data['accessorId']) ? $data['accessorId'] : null;
        $this->container['accessorType'] = isset($data['accessorType']) ? $data['accessorType'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        if ($this->container['accessorId'] === null) {
            $invalid_properties[] = "'accessorId' can't be null";
        }
        if ($this->container['accessorType'] === null) {
            $invalid_properties[] = "'accessorType' can't be null";
        }
        $allowed_values = ["character", "corporation", "alliance"];
        if (!in_array($this->container['accessorType'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'accessorType', must be one of #{allowed_values}.";
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
        if ($this->container['accessorId'] === null) {
            return false;
        }
        if ($this->container['accessorType'] === null) {
            return false;
        }
        $allowed_values = ["character", "corporation", "alliance"];
        if (!in_array($this->container['accessorType'], $allowed_values)) {
            return false;
        }
        return true;
    }


    /**
     * Gets accessorId
     * @return int
     */
    public function getAccessorId()
    {
        return $this->container['accessorId'];
    }

    /**
     * Sets accessorId
     * @param int $accessorId ID of an allowed channel member
     * @return $this
     */
    public function setAccessorId($accessorId)
    {
        $this->container['accessorId'] = $accessorId;

        return $this;
    }

    /**
     * Gets accessorType
     * @return string
     */
    public function getAccessorType()
    {
        return $this->container['accessorType'];
    }

    /**
     * Sets accessorType
     * @param string $accessorType accessor_type string
     * @return $this
     */
    public function setAccessorType($accessorType)
    {
        $allowed_values = array('character', 'corporation', 'alliance');
        if ((!in_array($accessorType, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'accessorType', must be one of 'character', 'corporation', 'alliance'");
        }
        $this->container['accessorType'] = $accessorType;

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

