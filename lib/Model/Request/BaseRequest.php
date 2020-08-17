<?php


namespace Wix\Mediaplatform\Model\Request;


abstract class BaseRequest
{
    public static function factory() {
        return new static();
    }

    /**
     * Default Object to Array deep recursion
     * @return array
     */
    public function toArray() {
        $vars = get_object_vars($this);
        $ret = array();
        foreach($vars as $key => $value) {
            if(is_object($value) && method_exists($value,"toArray")) {
                $ret[$key] = $value->toArray();
            } elseif(!is_null($value)) {
                $ret[$key] = $value;
            }
        }

        return $ret;
    }
}