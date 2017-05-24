<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:20
 */

namespace Wix\Mediaplatform\Model\Metadata\Basic;


/**
 * Class VideoBasicMetadata
 * @package Wix\Mediaplatform\Model\Metadata\Basic
 */
class VideoBasicMetadata implements BasicMetadata
{
    /**
     * @var boolean
     */
    private $interlaced;

    /**
     * @var array[VideoStream]
     */
    private $videoStreams;

    /**
     * @var array[AudioStream]
     */
    private $audioStreams;

    /**
     * @var VideoFormat
     */
    private $format;

    /**
     * VideoBasicMetadata constructor.
     */
    public function __construct() {
}

    /**
     * @return bool
     */
    public function getInterlaced() {
        return $this->interlaced;
    }

    /**
     * @return array
     */
    public function getVideoStreams() {
        return $this->videoStreams;
    }

    /**
     * @return array
     */
    public function getAudioStreams() {
        return $this->audioStreams;
    }

    /**
     * @return VideoFormat
     */
    public function getFormat() {
        return $this->format;
    }

    /**
     * @return string
     */
    public function __toString() {
        return "VideoBasicMetadata{" .
            "interlaced=" . $this->interlaced .
            ", videoStreams=" . join(',', $this->videoStreams) .
            ", audioStreams=" . join(',', $this->audioStreams) .
            ", format=" . $this->format .
            '}';
    }   
}