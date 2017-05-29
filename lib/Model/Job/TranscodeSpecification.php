<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 12:59
 */

namespace Wix\Mediaplatform\Model\Job;

use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class TranscodeSpecification
 * @package Wix\Mediaplatform\Model\Job
 */
class TranscodeSpecification extends BaseModel implements Specification
{

    /**
     * @var Destination
     */
    protected $destination;

    /**
     * @var string
     */
    protected $quality;

    /**
     * @var Video
     */
    protected $video;

    /**
     * @var Audio
     */
    protected $audio;

    /**
     * TranscodeSpecification constructor.
     */
    public function __construct(Array $payload) {
        parent::__construct();

        $this->video = !empty($payload['video']) ? new Video($payload['video']) : null;
        $this->audio = !empty($payload['audio']) ? new Audio($payload['audio']) : null;
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