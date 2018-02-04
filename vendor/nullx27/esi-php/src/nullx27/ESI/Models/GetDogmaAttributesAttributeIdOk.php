<?php
/**
 * GetDogmaAttributesAttributeIdOk
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
 * GetDogmaAttributesAttributeIdOk Class Doc Comment
 *
 * @category Class
 * @description 200 ok object
 * @package  nullx27\ESI
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class GetDogmaAttributesAttributeIdOk implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'get_dogma_attributes_attribute_id_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'attributeId' => 'int',
        'name' => 'string',
        'description' => 'string',
        'iconId' => 'int',
        'defaultValue' => 'float',
        'published' => 'bool',
        'displayName' => 'string',
        'unitId' => 'int',
        'stackable' => 'bool',
        'highIsGood' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'attributeId' => 'int32',
        'name' => null,
        'description' => null,
        'iconId' => 'int32',
        'defaultValue' => 'float',
        'published' => null,
        'displayName' => null,
        'unitId' => 'int32',
        'stackable' => null,
        'highIsGood' => null
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
        'attributeId' => 'attribute_id',
        'name' => 'name',
        'description' => 'description',
        'iconId' => 'icon_id',
        'defaultValue' => 'default_value',
        'published' => 'published',
        'displayName' => 'display_name',
        'unitId' => 'unit_id',
        'stackable' => 'stackable',
        'highIsGood' => 'high_is_good'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'attributeId' => 'setAttributeId',
        'name' => 'setName',
        'description' => 'setDescription',
        'iconId' => 'setIconId',
        'defaultValue' => 'setDefaultValue',
        'published' => 'setPublished',
        'displayName' => 'setDisplayName',
        'unitId' => 'setUnitId',
        'stackable' => 'setStackable',
        'highIsGood' => 'setHighIsGood'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'attributeId' => 'getAttributeId',
        'name' => 'getName',
        'description' => 'getDescription',
        'iconId' => 'getIconId',
        'defaultValue' => 'getDefaultValue',
        'published' => 'getPublished',
        'displayName' => 'getDisplayName',
        'unitId' => 'getUnitId',
        'stackable' => 'getStackable',
        'highIsGood' => 'getHighIsGood'
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
        $this->container['attributeId'] = isset($data['attributeId']) ? $data['attributeId'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['iconId'] = isset($data['iconId']) ? $data['iconId'] : null;
        $this->container['defaultValue'] = isset($data['defaultValue']) ? $data['defaultValue'] : null;
        $this->container['published'] = isset($data['published']) ? $data['published'] : null;
        $this->container['displayName'] = isset($data['displayName']) ? $data['displayName'] : null;
        $this->container['unitId'] = isset($data['unitId']) ? $data['unitId'] : null;
        $this->container['stackable'] = isset($data['stackable']) ? $data['stackable'] : null;
        $this->container['highIsGood'] = isset($data['highIsGood']) ? $data['highIsGood'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['attributeId'] === null) {
            $invalidProperties[] = "'attributeId' can't be null";
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

        if ($this->container['attributeId'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets attributeId
     *
     * @return int
     */
    public function getAttributeId()
    {
        return $this->container['attributeId'];
    }

    /**
     * Sets attributeId
     *
     * @param int $attributeId attribute_id integer
     *
     * @return $this
     */
    public function setAttributeId($attributeId)
    {
        $this->container['attributeId'] = $attributeId;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name string
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description description string
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets iconId
     *
     * @return int
     */
    public function getIconId()
    {
        return $this->container['iconId'];
    }

    /**
     * Sets iconId
     *
     * @param int $iconId icon_id integer
     *
     * @return $this
     */
    public function setIconId($iconId)
    {
        $this->container['iconId'] = $iconId;

        return $this;
    }

    /**
     * Gets defaultValue
     *
     * @return float
     */
    public function getDefaultValue()
    {
        return $this->container['defaultValue'];
    }

    /**
     * Sets defaultValue
     *
     * @param float $defaultValue default_value number
     *
     * @return $this
     */
    public function setDefaultValue($defaultValue)
    {
        $this->container['defaultValue'] = $defaultValue;

        return $this;
    }

    /**
     * Gets published
     *
     * @return bool
     */
    public function getPublished()
    {
        return $this->container['published'];
    }

    /**
     * Sets published
     *
     * @param bool $published published boolean
     *
     * @return $this
     */
    public function setPublished($published)
    {
        $this->container['published'] = $published;

        return $this;
    }

    /**
     * Gets displayName
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->container['displayName'];
    }

    /**
     * Sets displayName
     *
     * @param string $displayName display_name string
     *
     * @return $this
     */
    public function setDisplayName($displayName)
    {
        $this->container['displayName'] = $displayName;

        return $this;
    }

    /**
     * Gets unitId
     *
     * @return int
     */
    public function getUnitId()
    {
        return $this->container['unitId'];
    }

    /**
     * Sets unitId
     *
     * @param int $unitId unit_id integer
     *
     * @return $this
     */
    public function setUnitId($unitId)
    {
        $this->container['unitId'] = $unitId;

        return $this;
    }

    /**
     * Gets stackable
     *
     * @return bool
     */
    public function getStackable()
    {
        return $this->container['stackable'];
    }

    /**
     * Sets stackable
     *
     * @param bool $stackable stackable boolean
     *
     * @return $this
     */
    public function setStackable($stackable)
    {
        $this->container['stackable'] = $stackable;

        return $this;
    }

    /**
     * Gets highIsGood
     *
     * @return bool
     */
    public function getHighIsGood()
    {
        return $this->container['highIsGood'];
    }

    /**
     * Sets highIsGood
     *
     * @param bool $highIsGood high_is_good boolean
     *
     * @return $this
     */
    public function setHighIsGood($highIsGood)
    {
        $this->container['highIsGood'] = $highIsGood;

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


