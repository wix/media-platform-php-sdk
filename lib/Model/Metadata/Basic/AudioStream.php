<?php


namespace Wix\Mediaplatform\Model\Metadata\Basic;

use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class AudioStream
 * @package Wix\Mediaplatform\Model\Metadata\Basic
 */
class AudioStream extends BaseModel
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
    public function __toString()
    {
        return "AudioStream{" .
            "codecLongName='" . $this->codecLongName . '\'' .
            ", codecTag='" . $this->codecTag . '\'' .
            ", codecName='" . $this->codecName . '\'' .
            ", duration=" . $this->duration .
            ", bitrate=" . $this->bitrate .
            ", index=" . $this->index .
            '}';
    }
}