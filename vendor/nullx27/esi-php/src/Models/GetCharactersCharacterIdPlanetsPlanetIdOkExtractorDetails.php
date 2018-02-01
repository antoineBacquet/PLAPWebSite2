<?php
/**
 * GetCharactersCharacterIdPlanetsPlanetIdOkExtractorDetails
 *
 * PHP version 5
 *
 * @category Class
 * @package  nullx27\ESI
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * EVE Swagger Interface
 *
 * An OpenAPI for EVE Online
 *
 * OpenAPI spec version: 0.3.10.dev17
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace nullx27\ESI\Models;

use \ArrayAccess;

/**
 * GetCharactersCharacterIdPlanetsPlanetIdOkExtractorDetails Class Doc Comment
 *
 * @category    Class */
 // @description extractor_details object
/** 
 * @package     nullx27\ESI
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class GetCharactersCharacterIdPlanetsPlanetIdOkExtractorDetails implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'get_characters_character_id_planets_planet_id_ok_extractor_details';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = array(
        'cycleTime' => 'int',
        'headRadius' => 'float',
        'heads' => '\nullx27\ESI\Models\GetCharactersCharacterIdPlanetsPlanetIdOkExtractorDetailsHeads[]',
        'productTypeId' => 'int',
        'qtyPerCycle' => 'int'
    );

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = array(
        'cycleTime' => 'cycle_time',
        'headRadius' => 'head_radius',
        'heads' => 'heads',
        'productTypeId' => 'product_type_id',
        'qtyPerCycle' => 'qty_per_cycle'
    );

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = array(
        'cycleTime' => 'setCycleTime',
        'headRadius' => 'setHeadRadius',
        'heads' => 'setHeads',
        'productTypeId' => 'setProductTypeId',
        'qtyPerCycle' => 'setQtyPerCycle'
    );

    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = array(
        'cycleTime' => 'getCycleTime',
        'headRadius' => 'getHeadRadius',
        'heads' => 'getHeads',
        'productTypeId' => 'getProductTypeId',
        'qtyPerCycle' => 'getQtyPerCycle'
    );

    public static function getters()
    {
        return self::$getters;
    }

    

    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = array();

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['cycleTime'] = isset($data['cycleTime']) ? $data['cycleTime'] : null;
        $this->container['headRadius'] = isset($data['headRadius']) ? $data['headRadius'] : null;
        $this->container['heads'] = isset($data['heads']) ? $data['heads'] : null;
        $this->container['productTypeId'] = isset($data['productTypeId']) ? $data['productTypeId'] : null;
        $this->container['qtyPerCycle'] = isset($data['qtyPerCycle']) ? $data['qtyPerCycle'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = array();
        if ($this->container['cycleTime'] === null) {
            $invalid_properties[] = "'cycleTime' can't be null";
        }
        if ($this->container['headRadius'] === null) {
            $invalid_properties[] = "'headRadius' can't be null";
        }
        if ($this->container['heads'] === null) {
            $invalid_properties[] = "'heads' can't be null";
        }
        if ($this->container['productTypeId'] === null) {
            $invalid_properties[] = "'productTypeId' can't be null";
        }
        if ($this->container['qtyPerCycle'] === null) {
            $invalid_properties[] = "'qtyPerCycle' can't be null";
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
        if ($this->container['cycleTime'] === null) {
            return false;
        }
        if ($this->container['headRadius'] === null) {
            return false;
        }
        if ($this->container['heads'] === null) {
            return false;
        }
        if ($this->container['productTypeId'] === null) {
            return false;
        }
        if ($this->container['qtyPerCycle'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets cycleTime
     * @return int
     */
    public function getCycleTime()
    {
        return $this->container['cycleTime'];
    }

    /**
     * Sets cycleTime
     * @param int $cycleTime in seconds
     * @return $this
     */
    public function setCycleTime($cycleTime)
    {
        $this->container['cycleTime'] = $cycleTime;

        return $this;
    }

    /**
     * Gets headRadius
     * @return float
     */
    public function getHeadRadius()
    {
        return $this->container['headRadius'];
    }

    /**
     * Sets headRadius
     * @param float $headRadius head_radius number
     * @return $this
     */
    public function setHeadRadius($headRadius)
    {
        $this->container['headRadius'] = $headRadius;

        return $this;
    }

    /**
     * Gets heads
     * @return \nullx27\ESI\Models\GetCharactersCharacterIdPlanetsPlanetIdOkExtractorDetailsHeads[]
     */
    public function getHeads()
    {
        return $this->container['heads'];
    }

    /**
     * Sets heads
     * @param \nullx27\ESI\Models\GetCharactersCharacterIdPlanetsPlanetIdOkExtractorDetailsHeads[] $heads heads array
     * @return $this
     */
    public function setHeads($heads)
    {
        $this->container['heads'] = $heads;

        return $this;
    }

    /**
     * Gets productTypeId
     * @return int
     */
    public function getProductTypeId()
    {
        return $this->container['productTypeId'];
    }

    /**
     * Sets productTypeId
     * @param int $productTypeId product_type_id integer
     * @return $this
     */
    public function setProductTypeId($productTypeId)
    {
        $this->container['productTypeId'] = $productTypeId;

        return $this;
    }

    /**
     * Gets qtyPerCycle
     * @return int
     */
    public function getQtyPerCycle()
    {
        return $this->container['qtyPerCycle'];
    }

    /**
     * Sets qtyPerCycle
     * @param int $qtyPerCycle qty_per_cycle integer
     * @return $this
     */
    public function setQtyPerCycle($qtyPerCycle)
    {
        $this->container['qtyPerCycle'] = $qtyPerCycle;

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


