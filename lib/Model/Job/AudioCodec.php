<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 12:47
 */

namespace Wix\Mediaplatform\Model\Job;


/**
 * Class AudioCodec
 * @package Wix\Mediaplatform\Model\Job
 */
class AudioCodec
{
    /**
     * @var float
     */
    private $cbr;

    /**
     * @var string
     */
    private $name;

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