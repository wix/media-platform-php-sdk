<?php


namespace Wix\Mediaplatform\Image;


/**
 * Class Option
 * @package Wix\Mediaplatform\Image
 */
abstract class Option
{
    /**
     * @var string
     */
    private $key;

    /**
     * Option constructor.
     * @param string $key
     */
    public function __construct($key) {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getKey() {
        return $this->key;
    }

    /**
     * @param $value
     * @return string
     */
    public function decimalString($value) {
        return sprintf( "%.2f", $value);
    }

    /**
     * @return string
     */
    public abstract function serialize();

    /**
     * @param array $params
     * @return mixed
     */
    public abstract function deserialize(array $params);
}