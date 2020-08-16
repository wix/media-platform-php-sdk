<?php


namespace Wix\Mediaplatform\Model\Job;
use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class AudioSpecification
 * @package Wix\Mediaplatform\Model\Job
 */
class AudioSpecification extends BaseModel
{
    /**
     * @var string
     */
    protected $channels;

    /**
     * @var AudioCodec
     */
    protected $codec;

    /**
     * AudioSpecification constructor.
     */
    public function __construct(Array $payload = null)
    {
        parent::__construct($payload);
        $this->codec = $payload && !empty($payload['codec']) ? new AudioCodec($payload['codec']) : null;
    }

    /**
     * @return string
     */
    public function getChannels()
    {
        return $this->channels;
    }

    /**
     * @return AudioCodec
     */
    public function getCodec()
    {
        return $this->codec;
    }

    /**
     * @param string $channels
     * @return AudioSpecification
     */
    public function setChannels($channels)
    {
        $this->channels = $channels;
        return $this;
    }

    /**
     * @param AudioCodec $codec
     * @return AudioSpecification
     */
    public function setCodec(AudioCodec $codec)
    {
        $this->codec = $codec;
        return $this;
    }



    /**
     * @return string
     */
    public function __toString()
    {
        return "AudioSpecification{" .
            "channels='" . $this->channels . '\'' .
            ", codec=" . $this->codec .
            '}';
    }
}