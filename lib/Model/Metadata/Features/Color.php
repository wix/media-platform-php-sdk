<?php


namespace Wix\Mediaplatform\Model\Metadata\Features;

use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class Color
 * @package Wix\Mediaplatform\Model\Metadata\Features
 */
class Color extends BaseModel
{

    /**
     * @var int
     */
    protected $r;

    /**
     * @var int
     */
    protected $g;

    /**
     * @var int
     */
    protected $b;

    /**
     * @var float
     */
    protected $pixelFraction;

    /**
     * @var float
     */
    protected $score;


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