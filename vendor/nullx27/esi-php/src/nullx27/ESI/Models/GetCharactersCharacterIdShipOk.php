<?php
/**
 * GetCharactersCharacterIdShipOk
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
 * GetCharactersCharacterIdShipOk Class Doc Comment
 *
 * @category Class
 * @description 200 ok object
 * @package  nullx27\ESI
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class GetCharactersCharacterIdShipOk implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'get_characters_character_id_ship_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'shipTypeId' => 'int',
        'shipItemId' => 'int',
        'shipName' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'shipTypeId' => 'int32',
        'shipItemId' => 'int64',
        'shipName' => null
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
        'shipTypeId' => 'ship_type_id',
        'shipItemId' => 'ship_item_id',
        'shipName' => 'ship_name'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'shipTypeId' => 'setShipTypeId',
        'shipItemId' => 'setShipItemId',
        'shipName' => 'setShipName'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'shipTypeId' => 'getShipTypeId',
        'shipItemId' => 'getShipItemId',
        'shipName' => 'getShipName'
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
        $this->container['shipTypeId'] = isset($data['shipTypeId']) ? $data['shipTypeId'] : null;
        $this->container['shipItemId'] = isset($data['shipItemId']) ? $data['shipItemId'] : null;
        $this->container['shipName'] = isset($data['shipName']) ? $data['shipName'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['shipTypeId'] === null) {
            $invalidProperties[] = "'shipTypeId' can't be null";
        }
        if ($this->container['shipItemId'] === null) {
            $invalidProperties[] = "'shipItemId' can't be null";
        }
        if ($this->container['shipName'] === null) {
            $invalidProperties[] = "'shipName' can't be null";
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

        if ($this->container['shipTypeId'] === null) {
            return false;
        }
        if ($this->container['shipItemId'] === null) {
            return false;
        }
        if ($this->container['shipName'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets shipTypeId
     *
     * @return int
     */
    public function getShipTypeId()
    {
        return $this->container['shipTypeId'];
    }

    /**
     * Sets shipTypeId
     *
     * @param int $shipTypeId ship_type_id integer
     *
     * @return $this
     */
    public function setShipTypeId($shipTypeId)
    {
        $this->container['shipTypeId'] = $shipTypeId;

        return $this;
    }

    /**
     * Gets shipItemId
     *
     * @return int
     */
    public function getShipItemId()
    {
        return $this->container['shipItemId'];
    }

    /**
     * Sets shipItemId
     *
     * @param int $shipItemId Item id's are unique to a ship and persist until it is repackaged. This value can be used to track repeated uses of a ship, or detect when a pilot changes into a different instance of the same ship type.
     *
     * @return $this
     */
    public function setShipItemId($shipItemId)
    {
        $this->container['shipItemId'] = $shipItemId;

        return $this;
    }

    /**
     * Gets shipName
     *
     * @return string
     */
    public function getShipName()
    {
        return $this->container['shipName'];
    }

    /**
     * Sets shipName
     *
     * @param string $shipName ship_name string
     *
     * @return $this
     */
    public function setShipName($shipName)
    {
        $this->container['shipName'] = $shipName;

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


