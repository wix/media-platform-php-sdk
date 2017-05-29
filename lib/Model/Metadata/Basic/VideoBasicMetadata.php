<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:20
 */

namespace Wix\Mediaplatform\Model\Metadata\Basic;

use Wix\Mediaplatform\Model\BaseModel;

/**
 * Class VideoBasicMetadata
 * @package Wix\Mediaplatform\Model\Metadata\Basic
 */
class VideoBasicMetadata extends BaseModel implements BasicMetadata
{
    const MEDIA_TYPE = 'video';

    /**
     * @var boolean
     */
    protected $interlaced;

    /**
     * @var array[VideoStream]
     */
    protected $videoStreams;

    /**
     * @var array[AudioStream]
     */
    protected $audioStreams;

    /**
     * @var VideoFormat
     */
    protected $format;

    public function __construct(Array $payload) {
        parent::__construct($payload);

        $this->videoStreams = array();
        if(is_array($payload['videoStreams']) && !empty($payload['videoStreams'])) {
            foreach($payload['videoStreams'] as $videoStream) {
                $this->videoStreams[] = new VideoStream($videoStream);
            }
        }

        $this->audioStreams = array();
        if(is_array($payload['audioStreams']) && !empty($payload['audioStreams'])) {
            foreach($payload['audioStreams'] as $audioStream) {
                $this->audioStreams[] = new AudioStream($audioStream);
            }
        }

        $this->format = new VideoFormat($payload['format']);
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