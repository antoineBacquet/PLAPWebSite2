<?php
/**
 * GetCharactersCharacterIdClonesJumpClone
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
 * GetCharactersCharacterIdClonesJumpClone Class Doc Comment
 *
 * @category Class
 * @description jump_clone object
 * @package  nullx27\ESI
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class GetCharactersCharacterIdClonesJumpClone implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'get_characters_character_id_clones_jump_clone';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'jumpCloneId' => 'int',
        'name' => 'string',
        'locationId' => 'int',
        'locationType' => 'string',
        'implants' => 'int[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'jumpCloneId' => 'int32',
        'name' => null,
        'locationId' => 'int64',
        'locationType' => null,
        'implants' => 'int32'
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
        'jumpCloneId' => 'jump_clone_id',
        'name' => 'name',
        'locationId' => 'location_id',
        'locationType' => 'location_type',
        'implants' => 'implants'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'jumpCloneId' => 'setJumpCloneId',
        'name' => 'setName',
        'locationId' => 'setLocationId',
        'locationType' => 'setLocationType',
        'implants' => 'setImplants'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'jumpCloneId' => 'getJumpCloneId',
        'name' => 'getName',
        'locationId' => 'getLocationId',
        'locationType' => 'getLocationType',
        'implants' => 'getImplants'
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

    const LOCATION_TYPE_STATION = 'station';
    const LOCATION_TYPE_STRUCTURE = 'structure';
    

    
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getLocationTypeAllowableValues()
    {
        return [
            self::LOCATION_TYPE_STATION,
            self::LOCATION_TYPE_STRUCTURE,
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
        $this->container['jumpCloneId'] = isset($data['jumpCloneId']) ? $data['jumpCloneId'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['locationId'] = isset($data['locationId']) ? $data['locationId'] : null;
        $this->container['locationType'] = isset($data['locationType']) ? $data['locationType'] : null;
        $this->container['implants'] = isset($data['implants']) ? $data['implants'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['jumpCloneId'] === null) {
            $invalidProperties[] = "'jumpCloneId' can't be null";
        }
        if ($this->container['locationId'] === null) {
            $invalidProperties[] = "'locationId' can't be null";
        }
        if ($this->container['locationType'] === null) {
            $invalidProperties[] = "'locationType' can't be null";
        }
        $allowedValues = $this->getLocationTypeAllowableValues();
        if (!in_array($this->container['locationType'], $allowedValues)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'locationType', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['implants'] === null) {
            $invalidProperties[] = "'implants' can't be null";
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

        if ($this->container['jumpCloneId'] === null) {
            return false;
        }
        if ($this->container['locationId'] === null) {
            return false;
        }
        if ($this->container['locationType'] === null) {
            return false;
        }
        $allowedValues = $this->getLocationTypeAllowableValues();
        if (!in_array($this->container['locationType'], $allowedValues)) {
            return false;
        }
        if ($this->container['implants'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets jumpCloneId
     *
     * @return int
     */
    public function getJumpCloneId()
    {
        return $this->container['jumpCloneId'];
    }

    /**
     * Sets jumpCloneId
     *
     * @param int $jumpCloneId jump_clone_id integer
     *
     * @return $this
     */
    public function setJumpCloneId($jumpCloneId)
    {
        $this->container['jumpCloneId'] = $jumpCloneId;

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
     * Gets locationId
     *
     * @return int
     */
    public function getLocationId()
    {
        return $this->container['locationId'];
    }

    /**
     * Sets locationId
     *
     * @param int $locationId location_id integer
     *
     * @return $this
     */
    public function setLocationId($locationId)
    {
        $this->container['locationId'] = $locationId;

        return $this;
    }

    /**
     * Gets locationType
     *
     * @return string
     */
    public function getLocationType()
    {
        return $this->container['locationType'];
    }

    /**
     * Sets locationType
     *
     * @param string $locationType location_type string
     *
     * @return $this
     */
    public function setLocationType($locationType)
    {
        $allowedValues = $this->getLocationTypeAllowableValues();
        if (!in_array($locationType, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'locationType', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['locationType'] = $locationType;

        return $this;
    }

    /**
     * Gets implants
     *
     * @return int[]
     */
    public function getImplants()
    {
        return $this->container['implants'];
    }

    /**
     * Sets implants
     *
     * @param int[] $implants implants array
     *
     * @return $this
     */
    public function setImplants($implants)
    {
        $this->container['implants'] = $implants;

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


