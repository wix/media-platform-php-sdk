<?php


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
     * @var QualityRange
     */
    protected $qualityRange;

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
    public function __construct(Array $payload = null) {
        parent::__construct($payload);

        $this->destination = $payload && !empty($payload['destination']) ? new Destination($payload['destination']) : null;
        $this->qualityRange = $payload && !empty($payload['qualityRange']) ? new QualityRange($payload['qualityRange']) : null;
        $this->video = $payload && !empty($payload['video']) ? new Video($payload['video']) : null;
        $this->audio = $payload && !empty($payload['audio']) ? new Audio($payload['audio']) : null;
    }

    /**
     * @param Destination $destination
     * @return TranscodeSpecification
     */
    public function setDestination(Destination $destination)
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @param string $quality
     * @return TranscodeSpecification
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;
        return $this;
    }

    /**
     * @param Video $video
     * @return TranscodeSpecification
     */
    public function setVideo(Video $video)
    {
        $this->video = $video;
        return $this;
    }

    /**
     * @return string
     */
    public function getQualityRange()
    {
        return $this->qualityRange;
    }

    /**
     * @param string $qualityRange
     * @return TranscodeSpecification
     */
    public function setQualityRange($qualityRange)
    {
        $this->qualityRange = $qualityRange;
        return $this;
    }

    /**
     * @param Audio $audio
     * @return TranscodeSpecification
     */
    public function setAudio(Audio $audio)
    {
        $this->audio = $audio;
        return $this;
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