<?php
/**
 * GetUniverseTypesTypeIdOk
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
 * GetUniverseTypesTypeIdOk Class Doc Comment
 *
 * @category Class
 * @description 200 ok object
 * @package  nullx27\ESI
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class GetUniverseTypesTypeIdOk implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'get_universe_types_type_id_ok';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'typeId' => 'int',
        'name' => 'string',
        'description' => 'string',
        'published' => 'bool',
        'groupId' => 'int',
        'marketGroupId' => 'int',
        'radius' => 'float',
        'volume' => 'float',
        'packagedVolume' => 'float',
        'iconId' => 'int',
        'capacity' => 'float',
        'portionSize' => 'int',
        'mass' => 'float',
        'graphicId' => 'int',
        'dogmaAttributes' => '\nullx27\ESI\nullx27\ESI\Models\GetUniverseTypesTypeIdDogmaAttribute[]',
        'dogmaEffects' => '\nullx27\ESI\nullx27\ESI\Models\GetUniverseTypesTypeIdDogmaEffect[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'typeId' => 'int32',
        'name' => null,
        'description' => null,
        'published' => null,
        'groupId' => 'int32',
        'marketGroupId' => 'int32',
        'radius' => 'float',
        'volume' => 'float',
        'packagedVolume' => 'float',
        'iconId' => 'int32',
        'capacity' => 'float',
        'portionSize' => 'int32',
        'mass' => 'float',
        'graphicId' => 'int32',
        'dogmaAttributes' => null,
        'dogmaEffects' => null
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
        'typeId' => 'type_id',
        'name' => 'name',
        'description' => 'description',
        'published' => 'published',
        'groupId' => 'group_id',
        'marketGroupId' => 'market_group_id',
        'radius' => 'radius',
        'volume' => 'volume',
        'packagedVolume' => 'packaged_volume',
        'iconId' => 'icon_id',
        'capacity' => 'capacity',
        'portionSize' => 'portion_size',
        'mass' => 'mass',
        'graphicId' => 'graphic_id',
        'dogmaAttributes' => 'dogma_attributes',
        'dogmaEffects' => 'dogma_effects'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'typeId' => 'setTypeId',
        'name' => 'setName',
        'description' => 'setDescription',
        'published' => 'setPublished',
        'groupId' => 'setGroupId',
        'marketGroupId' => 'setMarketGroupId',
        'radius' => 'setRadius',
        'volume' => 'setVolume',
        'packagedVolume' => 'setPackagedVolume',
        'iconId' => 'setIconId',
        'capacity' => 'setCapacity',
        'portionSize' => 'setPortionSize',
        'mass' => 'setMass',
        'graphicId' => 'setGraphicId',
        'dogmaAttributes' => 'setDogmaAttributes',
        'dogmaEffects' => 'setDogmaEffects'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'typeId' => 'getTypeId',
        'name' => 'getName',
        'description' => 'getDescription',
        'published' => 'getPublished',
        'groupId' => 'getGroupId',
        'marketGroupId' => 'getMarketGroupId',
        'radius' => 'getRadius',
        'volume' => 'getVolume',
        'packagedVolume' => 'getPackagedVolume',
        'iconId' => 'getIconId',
        'capacity' => 'getCapacity',
        'portionSize' => 'getPortionSize',
        'mass' => 'getMass',
        'graphicId' => 'getGraphicId',
        'dogmaAttributes' => 'getDogmaAttributes',
        'dogmaEffects' => 'getDogmaEffects'
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
        $this->container['typeId'] = isset($data['typeId']) ? $data['typeId'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['published'] = isset($data['published']) ? $data['published'] : null;
        $this->container['groupId'] = isset($data['groupId']) ? $data['groupId'] : null;
        $this->container['marketGroupId'] = isset($data['marketGroupId']) ? $data['marketGroupId'] : null;
        $this->container['radius'] = isset($data['radius']) ? $data['radius'] : null;
        $this->container['volume'] = isset($data['volume']) ? $data['volume'] : null;
        $this->container['packagedVolume'] = isset($data['packagedVolume']) ? $data['packagedVolume'] : null;
        $this->container['iconId'] = isset($data['iconId']) ? $data['iconId'] : null;
        $this->container['capacity'] = isset($data['capacity']) ? $data['capacity'] : null;
        $this->container['portionSize'] = isset($data['portionSize']) ? $data['portionSize'] : null;
        $this->container['mass'] = isset($data['mass']) ? $data['mass'] : null;
        $this->container['graphicId'] = isset($data['graphicId']) ? $data['graphicId'] : null;
        $this->container['dogmaAttributes'] = isset($data['dogmaAttributes']) ? $data['dogmaAttributes'] : null;
        $this->container['dogmaEffects'] = isset($data['dogmaEffects']) ? $data['dogmaEffects'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['typeId'] === null) {
            $invalidProperties[] = "'typeId' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ($this->container['published'] === null) {
            $invalidProperties[] = "'published' can't be null";
        }
        if ($this->container['groupId'] === null) {
            $invalidProperties[] = "'groupId' can't be null";
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

        if ($this->container['typeId'] === null) {
            return false;
        }
        if ($this->container['name'] === null) {
            return false;
        }
        if ($this->container['description'] === null) {
            return false;
        }
        if ($this->container['published'] === null) {
            return false;
        }
        if ($this->container['groupId'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets typeId
     *
     * @return int
     */
    public function getTypeId()
    {
        return $this->container['typeId'];
    }

    /**
     * Sets typeId
     *
     * @param int $typeId type_id integer
     *
     * @return $this
     */
    public function setTypeId($typeId)
    {
        $this->container['typeId'] = $typeId;

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
     * Gets groupId
     *
     * @return int
     */
    public function getGroupId()
    {
        return $this->container['groupId'];
    }

    /**
     * Sets groupId
     *
     * @param int $groupId group_id integer
     *
     * @return $this
     */
    public function setGroupId($groupId)
    {
        $this->container['groupId'] = $groupId;

        return $this;
    }

    /**
     * Gets marketGroupId
     *
     * @return int
     */
    public function getMarketGroupId()
    {
        return $this->container['marketGroupId'];
    }

    /**
     * Sets marketGroupId
     *
     * @param int $marketGroupId This only exists for types that can be put on the market
     *
     * @return $this
     */
    public function setMarketGroupId($marketGroupId)
    {
        $this->container['marketGroupId'] = $marketGroupId;

        return $this;
    }

    /**
     * Gets radius
     *
     * @return float
     */
    public function getRadius()
    {
        return $this->container['radius'];
    }

    /**
     * Sets radius
     *
     * @param float $radius radius number
     *
     * @return $this
     */
    public function setRadius($radius)
    {
        $this->container['radius'] = $radius;

        return $this;
    }

    /**
     * Gets volume
     *
     * @return float
     */
    public function getVolume()
    {
        return $this->container['volume'];
    }

    /**
     * Sets volume
     *
     * @param float $volume volume number
     *
     * @return $this
     */
    public function setVolume($volume)
    {
        $this->container['volume'] = $volume;

        return $this;
    }

    /**
     * Gets packagedVolume
     *
     * @return float
     */
    public function getPackagedVolume()
    {
        return $this->container['packagedVolume'];
    }

    /**
     * Sets packagedVolume
     *
     * @param float $packagedVolume packaged_volume number
     *
     * @return $this
     */
    public function setPackagedVolume($packagedVolume)
    {
        $this->container['packagedVolume'] = $packagedVolume;

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
     * Gets capacity
     *
     * @return float
     */
    public function getCapacity()
    {
        return $this->container['capacity'];
    }

    /**
     * Sets capacity
     *
     * @param float $capacity capacity number
     *
     * @return $this
     */
    public function setCapacity($capacity)
    {
        $this->container['capacity'] = $capacity;

        return $this;
    }

    /**
     * Gets portionSize
     *
     * @return int
     */
    public function getPortionSize()
    {
        return $this->container['portionSize'];
    }

    /**
     * Sets portionSize
     *
     * @param int $portionSize portion_size integer
     *
     * @return $this
     */
    public function setPortionSize($portionSize)
    {
        $this->container['portionSize'] = $portionSize;

        return $this;
    }

    /**
     * Gets mass
     *
     * @return float
     */
    public function getMass()
    {
        return $this->container['mass'];
    }

    /**
     * Sets mass
     *
     * @param float $mass mass number
     *
     * @return $this
     */
    public function setMass($mass)
    {
        $this->container['mass'] = $mass;

        return $this;
    }

    /**
     * Gets graphicId
     *
     * @return int
     */
    public function getGraphicId()
    {
        return $this->container['graphicId'];
    }

    /**
     * Sets graphicId
     *
     * @param int $graphicId graphic_id integer
     *
     * @return $this
     */
    public function setGraphicId($graphicId)
    {
        $this->container['graphicId'] = $graphicId;

        return $this;
    }

    /**
     * Gets dogmaAttributes
     *
     * @return \nullx27\ESI\nullx27\ESI\Models\GetUniverseTypesTypeIdDogmaAttribute[]
     */
    public function getDogmaAttributes()
    {
        return $this->container['dogmaAttributes'];
    }

    /**
     * Sets dogmaAttributes
     *
     * @param \nullx27\ESI\nullx27\ESI\Models\GetUniverseTypesTypeIdDogmaAttribute[] $dogmaAttributes dogma_attributes array
     *
     * @return $this
     */
    public function setDogmaAttributes($dogmaAttributes)
    {
        $this->container['dogmaAttributes'] = $dogmaAttributes;

        return $this;
    }

    /**
     * Gets dogmaEffects
     *
     * @return \nullx27\ESI\nullx27\ESI\Models\GetUniverseTypesTypeIdDogmaEffect[]
     */
    public function getDogmaEffects()
    {
        return $this->container['dogmaEffects'];
    }

    /**
     * Sets dogmaEffects
     *
     * @param \nullx27\ESI\nullx27\ESI\Models\GetUniverseTypesTypeIdDogmaEffect[] $dogmaEffects dogma_effects array
     *
     * @return $this
     */
    public function setDogmaEffects($dogmaEffects)
    {
        $this->container['dogmaEffects'] = $dogmaEffects;

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

