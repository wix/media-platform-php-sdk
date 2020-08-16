<?php


namespace Wix\Mediaplatform\Model\Metadata\Basic;

use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class VideoFormat
 * @package Wix\Mediaplatform\Model\Metadata\Basic
 */
class VideoFormat extends BaseModel
{
    /**
     * @var string
     */
    protected $formatLongName;

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
    protected $size;

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