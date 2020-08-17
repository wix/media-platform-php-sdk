<?php


namespace Wix\Mediaplatform\Geometry;

use Wix\Mediaplatform\Model\BaseModel;

/**
 * Class Rectangle
 * @package Wix\Mediaplatform\Geometry
 */
class Rectangle extends BaseModel
{
    /**
     * @var int
     */
    protected $x;

    /**
     * @var int
     */
    protected $y;

    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

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