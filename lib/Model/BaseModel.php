<?php


namespace Wix\Mediaplatform\Model;

use Wix\Mediaplatform\Model\Request\BaseRequest;

/**
 *  * Class BaseModel
 * @package Wix\Mediaplatform\Model
 */
class BaseModel extends BaseRequest
{
    public static function factory(Array $payload = null) {
        return new static($payload);
    }

    /**
     * BaseModel constructor.
     * Get payload as array and put it into the existing class properties
     * @param array $payload
     */
    public function __construct(Array $payload = null) {
        if(!is_null($payload) && is_array($payload)) {
            foreach($payload as $key => $value) {
                if(property_exists(static::class, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }
}