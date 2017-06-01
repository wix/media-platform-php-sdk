<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 15:12
 */

namespace Wix\Mediaplatform\Image;

/**
 * Class Validation
 * @package Wix\Mediaplatform\Image
 */
class Validation
{
    /**
     * @param int|float $value
     * @param int|float $lowerInclusive
     * @param int|float $upperInclusive
     * @return bool
     */
    public static function inRange($value, $lowerInclusive, $upperInclusive) {
        return $value >= $lowerInclusive && $value <= $upperInclusive;
    }

    /**
     * @param int $value
     * @param int $lowerInclusive
     * @return bool
     */
    public static function greaterThan($value, $lowerInclusive) {
        return $value >= $lowerInclusive;
    }
}