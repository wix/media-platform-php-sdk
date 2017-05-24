<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:20
 */

namespace Wix\Mediaplatform\Model\Metadata\Basic;


/**
 * Class ImageBasicMetadata
 * @package Wix\Mediaplatform\Model\Metadata\Basic
 */
class ImageBasicMetadata implements BasicMetadata
{
    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $width;

    /**
     * @var string
     */
    private $colorspace;

    /**
     * @var string
     */
    private $format;

    /**
     * ImageBasicMetadata constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return string
     */
    public function getColorspace()
    {
        return $this->colorspace;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "ImageBasicMetadata{" .
            "height=" . $this->height .
            ", width=" . $this->width .
            ", colorspace='" . $this->colorspace . '\'' .
            ", format='" . $this->format . '\'' .
            '}';
    }
}