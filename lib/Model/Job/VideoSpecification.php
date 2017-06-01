<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 13:07
 */

namespace Wix\Mediaplatform\Model\Job;

use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class VideoSpecification
 * @package Wix\Mediaplatform\Model\Job
 */
class VideoSpecification extends BaseModel
{
    /**
     * @var string
     */
    protected $frameRate;

    /**
     * @var VideoCodec
     */
    protected $codec;

    /**
     * @var Resolution
     */
    protected $resolution;

    /**
     * @var float
     */
    protected $keyFrame;

    /**
     * @return string
     */
    public function getFrameRate()
    {
        return $this->frameRate;
    }

    /**
     * @return VideoCodec
     */
    public function getCodec()
    {
        return $this->codec;
    }

    /**
     * @return Resolution
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * @return float
     */
    public function getKeyFrame()
    {
        return $this->keyFrame;
    }

    public function __construct(Array $payload) {
        parent::__construct($payload);
        $this->codec = !empty($payload['codec']) ? new VideoCodec($payload['codec']) : null;
        $this->resolution = !empty($payload['resolution']) ? new Resolution($payload['resolution']) : null;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return "VideoSpecification{" .
            "frameRate='" . $this->frameRate . '\'' .
            ", codec=" . $this->codec .
            ", resolution=" . $this->resolution .
            ", keyFrame=" . $this->keyFrame .
            '}';
    }
}