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
        $vars = get_object_vars($this);
        $ret = array();
        foreach($vars as $key => $value) {
            if(is_object($value) && method_exists($value,"toArray")) {
                $ret[$key] = $value->toArray();
            } else {
                $ret[$key] = $value;
            }
        }

        return $ret;
    }
}