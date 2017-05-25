<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 12:48
 */

namespace Wix\Mediaplatform\Model\Job;


/**
 * Class AudioSpecification
 * @package Wix\Mediaplatform\Model\Job
 */
class AudioSpecification
{
    /**
     * @var string
     */
    private $channels;

    /**
     * @var AudioCodec
     */
    private $codec;

    /**
     * AudioSpecification constructor.
     */
    public function __construct()
    {
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