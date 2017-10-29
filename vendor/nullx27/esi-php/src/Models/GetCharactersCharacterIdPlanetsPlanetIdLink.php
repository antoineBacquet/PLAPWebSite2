<?php
/**
 * GetCharactersCharacterIdPlanetsPlanetIdLink
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
 * GetCharactersCharacterIdPlanetsPlanetIdLink Class Doc Comment
 *
 * @category    Class */
 // @description link object
/**
 * @package     nullx27\ESI
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class GetCharactersCharacterIdPlanetsPlanetIdLink implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'get_characters_character_id_planets_planet_id_link';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'destinationPinId' => 'int',
        'linkLevel' => 'int',
        'sourcePinId' => 'int'
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
        'destinationPinId' => 'destination_pin_id',
        'linkLevel' => 'link_level',
        'sourcePinId' => 'source_pin_id'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'destinationPinId' => 'setDestinationPinId',
        'linkLevel' => 'setLinkLevel',
        'sourcePinId' => 'setSourcePinId'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'destinationPinId' => 'getDestinationPinId',
        'linkLevel' => 'getLinkLevel',
        'sourcePinId' => 'getSourcePinId'
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
        $this->container['destinationPinId'] = isset($data['destinationPinId']) ? $data['destinationPinId'] : null;
        $this->container['linkLevel'] = isset($data['linkLevel']) ? $data['linkLevel'] : null;
        $this->container['sourcePinId'] = isset($data['sourcePinId']) ? $data['sourcePinId'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        if ($this->container['destinationPinId'] === null) {
            $invalid_properties[] = "'destinationPinId' can't be null";
        }
        if ($this->container['linkLevel'] === null) {
            $invalid_properties[] = "'linkLevel' can't be null";
        }
        if (($this->container['linkLevel'] > 10)) {
            $invalid_properties[] = "invalid value for 'linkLevel', must be smaller than or equal to 10.";
        }

        if (($this->container['linkLevel'] < 0)) {
            $invalid_properties[] = "invalid value for 'linkLevel', must be bigger than or equal to 0.";
        }

        if ($this->container['sourcePinId'] === null) {
            $invalid_properties[] = "'sourcePinId' can't be null";
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
        if ($this->container['destinationPinId'] === null) {
            return false;
        }
        if ($this->container['linkLevel'] === null) {
            return false;
        }
        if ($this->container['linkLevel'] > 10) {
            return false;
        }
        if ($this->container['linkLevel'] < 0) {
            return false;
        }
        if ($this->container['sourcePinId'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets destinationPinId
     * @return int
     */
    public function getDestinationPinId()
    {
        return $this->container['destinationPinId'];
    }

    /**
     * Sets destinationPinId
     * @param int $destinationPinId destination_pin_id integer
     * @return $this
     */
    public function setDestinationPinId($destinationPinId)
    {
        $this->container['destinationPinId'] = $destinationPinId;

        return $this;
    }

    /**
     * Gets linkLevel
     * @return int
     */
    public function getLinkLevel()
    {
        return $this->container['linkLevel'];
    }

    /**
     * Sets linkLevel
     * @param int $linkLevel link_level integer
     * @return $this
     */
    public function setLinkLevel($linkLevel)
    {

        if (($linkLevel > 10)) {
            throw new \InvalidArgumentException('invalid value for $linkLevel when calling GetCharactersCharacterIdPlanetsPlanetIdLink., must be smaller than or equal to 10.');
        }
        if (($linkLevel < 0)) {
            throw new \InvalidArgumentException('invalid value for $linkLevel when calling GetCharactersCharacterIdPlanetsPlanetIdLink., must be bigger than or equal to 0.');
        }

        $this->container['linkLevel'] = $linkLevel;

        return $this;
    }

    /**
     * Gets sourcePinId
     * @return int
     */
    public function getSourcePinId()
    {
        return $this->container['sourcePinId'];
    }

    /**
     * Sets sourcePinId
     * @param int $sourcePinId source_pin_id integer
     * @return $this
     */
    public function setSourcePinId($sourcePinId)
    {
        $this->container['sourcePinId'] = $sourcePinId;

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


