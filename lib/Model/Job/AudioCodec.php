<?php


namespace Wix\Mediaplatform\Model\Job;
use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class AudioCodec
 * @package Wix\Mediaplatform\Model\Job
 */
class AudioCodec extends BaseModel
{
    /**
     * @var float
     */
    protected $cbr;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return float
     */
    public function getCbr()
    {
        return $this->cbr;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param float $cbr
     * @return AudioCodec
     */
    public function setCbr($cbr)
    {
        $this->cbr = $cbr;
        return $this;
    }

    /**
     * @param string $name
     * @return AudioCodec
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }



    /**
     * @return string
     */
    public function __toString()
    {
        return "AudioCodec{" .
            "cbr=" . $this->cbr .
            ", name='" . $this->name . '\'' .
            '}';
    }
}