<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:26
 */

namespace Wix\Mediaplatform\Model\Metadata\Basic;


/**
 * Class VideoFormat
 * @package Wix\Mediaplatform\Model\Metadata\Basic
 */
class VideoFormat
{
    /**
     * @var string
     */
    private $formatLongName;

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
    private $size;

    /**
     * VideoFormat constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getFormatLongName()
    {
        return $this->formatLongName;
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
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "VideoFormat{" .
            "formatLongName='" . $this->formatLongName . '\'' .
            ", duration=" . $this->duration .
            ", bitrate=" . $this->bitrate .
            ", size=" . $this->size .
            '}';
    }
}