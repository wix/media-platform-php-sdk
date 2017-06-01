<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 13:02
 */

namespace Wix\Mediaplatform\Model\Job;

use Wix\Mediaplatform\Model\BaseModel;

/**
 * Class VideoCodec
 * @package Wix\Mediaplatform\Model\Job
 */
class VideoCodec extends BaseModel
{
    /**
     * @var string
     */
    protected $profile;

    /**
     * @var float
     */
    protected $maxRate;

    /**
     * @var float
     */
    protected $crf;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $level;

    /**
     * @return string
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @return float
     */
    public function getMaxRate()
    {
        return $this->maxRate;
    }

    /**
     * @return float
     */
    public function getCrf()
    {
        return $this->crf;
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
    public function getLevel()
    {
        return $this->level;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return "VideoCodec{" .
            "profile='" . $this->profile . '\'' .
            ", maxRate=" . $this->maxRate .
            ", crf=" . $this->crf .
            ", name='" . $this->name . '\'' .
            ", level='" . $this->level . '\'' .
            '}';
    }
}