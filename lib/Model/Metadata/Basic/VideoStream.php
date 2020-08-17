<?php


namespace Wix\Mediaplatform\Model\Metadata\Basic;

use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class VideoStream
 * @package Wix\Mediaplatform\Model\Metadata\Basic
 */
class VideoStream extends BaseModel
{

    /**
     * @var string
     */
    protected $codecLongName;

    /**
     * @var string
     */
    protected $codecTag;

    /**
     * @var string
     */
    protected $codecName;

    /**
     * @var int
     */
    protected $height;

    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $duration;

    /**
     * @var float
     */
    protected $bitrate;

    /**
     * @var int
     */
    protected $index;

    /**
     * @var string
     */
    protected $rFrameRate;

    /**
     * @var string
     */
    protected $avgFrameRate;

    /**
     * @var string
     */
    protected $sampleAspectRatio;

    /**
     * @var string
     */
    protected $displayAspectRatio;

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