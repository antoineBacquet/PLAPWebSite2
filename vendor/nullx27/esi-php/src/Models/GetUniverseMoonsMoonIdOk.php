<?php
/**
 * GetUniverseMoonsMoonIdOk
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
 * GetUniverseMoonsMoonIdOk Class Doc Comment
 *
 * @category    Class */
 // @description 200 ok object
/**
 * @package     nullx27\ESI
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class GetUniverseMoonsMoonIdOk implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'get_universe_moons_moon_id_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'moonId' => 'int',
        'name' => 'string',
        'position' => '\nullx27\ESI\Models\GetUniverseMoonsMoonIdPosition',
        'systemId' => 'int'
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
        'moonId' => 'moon_id',
        'name' => 'name',
        'position' => 'position',
        'systemId' => 'system_id'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'moonId' => 'setMoonId',
        'name' => 'setName',
        'position' => 'setPosition',
        'systemId' => 'setSystemId'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'moonId' => 'getMoonId',
        'name' => 'getName',
        'position' => 'getPosition',
        'systemId' => 'getSystemId'
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
        $this->container['moonId'] = isset($data['moonId']) ? $data['moonId'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['position'] = isset($data['position']) ? $data['position'] : null;
        $this->container['systemId'] = isset($data['systemId']) ? $data['systemId'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        if ($this->container['moonId'] === null) {
            $invalid_properties[] = "'moonId' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalid_properties[] = "'name' can't be null";
        }
        if ($this->container['systemId'] === null) {
            $invalid_properties[] = "'systemId' can't be null";
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
        if ($this->container['moonId'] === null) {
            return false;
        }
        if ($this->container['name'] === null) {
            return false;
        }
        if ($this->container['systemId'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets moonId
     * @return int
     */
    public function getMoonId()
    {
        return $this->container['moonId'];
    }

    /**
     * Sets moonId
     * @param int $moonId moon_id integer
     * @return $this
     */
    public function setMoonId($moonId)
    {
        $this->container['moonId'] = $moonId;

        return $this;
    }

    /**
     * Gets name
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     * @param string $name name string
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets position
     * @return \nullx27\ESI\Models\GetUniverseMoonsMoonIdPosition
     */
    public function getPosition()
    {
        return $this->container['position'];
    }

    /**
     * Sets position
     * @param \nullx27\ESI\Models\GetUniverseMoonsMoonIdPosition $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->container['position'] = $position;

        return $this;
    }

    /**
     * Gets systemId
     * @return int
     */
    public function getSystemId()
    {
        return $this->container['systemId'];
    }

    /**
     * Sets systemId
     * @param int $systemId The solar system this moon is in
     * @return $this
     */
    public function setSystemId($systemId)
    {
        $this->container['systemId'] = $systemId;

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

