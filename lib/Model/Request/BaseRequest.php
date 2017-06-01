<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/05/2017
 * Time: 11:52
 */

namespace Wix\Mediaplatform\Model\Request;


abstract class BaseRequest
{

    /**
     * @return array
     */
    public function toArray() {
        return get_object_vars($this);
    }
}