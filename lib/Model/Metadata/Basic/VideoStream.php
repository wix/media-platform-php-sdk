<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:29
 */

namespace Wix\Mediaplatform\Model\Metadata\Basic;


/**
 * Class VideoStream
 * @package Wix\Mediaplatform\Model\Metadata\Basic
 */
class VideoStream
{

    /**
     * @var string
     */
    private $codecLongName;

    /**
     * @var string
     */
    private $codecTag;

    /**
     * @var string
     */
    private $codecName;

    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $duration;

    /**
     * @var float
     */
    private $bitrate;

    /**
     * @var int
     */
    private $index;

    /**
     * @var string
     */
    private $rFrameRate;

    /**
     * @var string
     */
    private $avgFrameRate;

    /**
     * @var string
     */
    private $sampleAspectRatio;

    /**
     * @var string
     */
    private $displayAspectRatio;

    /**
     * VideoStream constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getCodecLongName()
    {
        return $this->codecLongName;
    }

    /**
     * @return string
     */
    public function getCodecTag()
    {
        return $this->codecTag;
    }

    /**
     * @return string
     */
    public function getCodecName()
    {
        return $this->codecName;
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
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return float
     */
    public function getBitrate()
    {
        return $this->bitrate;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @return string
     */
    public function getRFrameRate()
    {
        return $this->rFrameRate;
    }

    /**
     * @return string
     */
    public function getAvgFrameRate()
    {
        return $this->avgFrameRate;
    }

    /**
     * @return string
     */
    public function getSampleAspectRatio()
    {
        return $this->sampleAspectRatio;
    }

    /**
     * @return string
     */
    public function getDisplayAspectRatio()
    {
        return $this->displayAspectRatio;
    }



    /**
     * @return string
     */
    public function __toString()
    {
        return "VideoStream{" .
            "codecLongName='" . $this->codecLongName . '\'' .
            ", codecTag='" . $this->codecTag . '\'' .
            ", codecName='" . $this->codecName . '\'' .
            ", height=" . $this->height .
            ", width=" . $this->width .
            ", duration=" . $this->duration .
            ", bitrate=" . $this->bitrate .
            ", index=" . $this->index .
            ", rFrameRate='" . $this->rFrameRate . '\'' .
            ", avgFrameRate='" . $this->avgFrameRate . '\'' .
            ", smapleAspectRatio='" . $this->sampleAspectRatio . '\'' .
            ", displayAspectRatio='" . $this->displayAspectRatio . '\'' .
            '}';
    }
}