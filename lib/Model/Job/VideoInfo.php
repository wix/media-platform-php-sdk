<?php


namespace Wix\Mediaplatform\Model\Job;

use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class VideoInfo
 * @package Wix\Mediaplatform\Model\Job
 */
class VideoInfo extends BaseModel
{
    /**
     * @var string
     */
    protected $format;

    /**
     * @var float
     */
    protected $videoBitrate;

    /**
     * @var float
     */
    protected $audioBitrate;

    /**
     * @var string
     */
    protected $quality;

    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    /**
     * @var string
     */
    protected $tag;

    /**
     * @var string
     */
    protected $fps;

    /**
     * @var float
     */
    protected $duration;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $displayAspectRatio;

    /**
     * VideoInfo constructor.
     */
    public function __construct(Array $payload = null) {
        parent::__construct($payload);
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