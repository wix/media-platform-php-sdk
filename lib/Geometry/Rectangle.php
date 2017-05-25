<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 14:32
 */

namespace Wix\Mediaplatform\Geometry;


/**
 * Class Rectangle
 * @package Wix\Mediaplatform\Geometry
 */
class Rectangle
{
    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * Rectangle constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return "Rectangle{" .
            "x=" . $this->x .
            ", y=" . $this->y .
            ", width=" . $this->width .
            ", height=" . $this->height .
            '}';
    }
}