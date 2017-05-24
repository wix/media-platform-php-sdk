<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:16
 */

namespace Wix\Mediaplatform\Model\Metadata\Basic;


/**
 * Class AudioStream
 * @package Wix\Mediaplatform\Model\Metadata\Basic
 */
class AudioStream
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
     * AudioStream constructor.
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