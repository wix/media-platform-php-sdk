<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 13:07
 */

namespace Wix\Mediaplatform\Model\Job;


/**
 * Class VideoSpecification
 * @package Wix\Mediaplatform\Model\Job
 */
class VideoSpecification
{
    /**
     * @var string
     */
    private $frameRate;

    /**
     * @var VideoCodec
     */
    private $codec;

    /**
     * @var Resolution
     */
    private $resolution;

    /**
     * @var float
     */
    private $keyFrame;

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