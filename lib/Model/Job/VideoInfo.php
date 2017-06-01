<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 13:05
 */

namespace Wix\Mediaplatform\Model\Job;


/**
 * Class VideoInfo
 * @package Wix\Mediaplatform\Model\Job
 */
class VideoInfo
{
    /**
     * @var string
     */
    private $format;

    /**
     * @var float
     */
    private $videoBitrate;

    /**
     * @var float
     */
    private $audioBitrate;

    /**
     * @var string
     */
    private $quality;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var string
     */
    private $tag;

    /**
     * @var string
     */
    private $fps;

    /**
     * @var float
     */
    private $duration;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $displayAspectRatio;

    /**
     * VideoInfo constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return float
     */
    public function getVideoBitrate()
    {
        return $this->videoBitrate;
    }

    /**
     * @return float
     */
    public function getAudioBitrate()
    {
        return $this->audioBitrate;
    }

    /**
     * @return string
     */
    public function getQuality()
    {
        return $this->quality;
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
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return string
     */
    public function getFps()
    {
        return $this->fps;
    }

    /**
     * @return float
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getDisplayAspectRatio()
    {
        return $this->displayAspectRatio;
    }


}