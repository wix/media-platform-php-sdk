<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 12:59
 */

namespace Wix\Mediaplatform\Model\Job;


/**
 * Class TranscodeSpecification
 * @package Wix\Mediaplatform\Model\Job
 */
class TranscodeSpecification implements Specification
{

    /**
     * @var Destination
     */
    private $destination;

    /**
     * @var string
     */
    private $quality;

    /**
     * @var Video
     */
    private $video;

    /**
     * @var Audio
     */
    private $audio;

    /**
     * TranscodeSpecification constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return Destination
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @return string
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * @return Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @return Audio
     */
    public function getAudio()
    {
        return $this->audio;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "TranscodeSpecification{" .
            "destination=" . $this->destination .
            ", quality='" . $this->quality . '\'' .
            ", video=" . $this->video .
            ", audio=" . $this->audio .
            '}';
    }
}