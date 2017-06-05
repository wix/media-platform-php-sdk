<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/05/2017
 * Time: 12:49
 */

namespace Wix\Mediaplatform\Model;

use Wix\Mediaplatform\Model\Request\BaseRequest;

/**
 *  * Class BaseModel
 * @package Wix\Mediaplatform\Model
 */
class BaseModel extends BaseRequest
{
    /**
     * @param array $payload
     */
    public static function factory(Array $payload = array()) {
            return new ${static::class}($payload);
    }

    /**
     * BaseModel constructor.
     * Get payload as array and put it into the existing class properties
     * @param array $payload
     */
    public function __construct(Array $payload = array()) {
        foreach($payload as $key => $value) {
            if(property_exists(static::class, $key)) {
                $this->$key = $value;
            }
        }
    }
}