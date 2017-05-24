<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:33
 */

namespace Wix\Mediaplatform\Model\Metadata\Features;


/**
 * Class Color
 * @package Wix\Mediaplatform\Model\Metadata\Features
 */
class Color
{

    /**
     * @var int
     */
    private $r;

    /**
     * @var int
     */
    private $g;

    /**
     * @var int
     */
    private $b;

    /**
     * @var float
     */
    private $pixelFraction;

    /**
     * @var float
     */
    private $score;

    /**
     * Color constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getR()
    {
        return $this->r;
    }

    /**
     * @return int
     */
    public function getG()
    {
        return $this->g;
    }

    /**
     * @return int
     */
    public function getB()
    {
        return $this->b;
    }

    /**
     * @return float
     */
    public function getPixelFraction()
    {
        return $this->pixelFraction;
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }



    /**
     * @return string
     */
    public function __toString()
    {
        return "Color{" .
            "r=" . $this->r .
            ", g=" . $this->g .
            ", b=" . $this->b .
            ", pixelFraction=" . $this->pixelFraction .
            ", score=" . $this->score .
            '}';
    }
}