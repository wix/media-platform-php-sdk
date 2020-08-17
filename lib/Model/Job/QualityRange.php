<?php


namespace Wix\Mediaplatform\Model\Job;

use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class QualityRange
 * @package Wix\Mediaplatform\Model\Job
 */
class QualityRange extends BaseModel
{
    /**
     * @var string
     */
    protected $minimum;

    /**
     * @var string
     */
    protected $maximum;

    /**
     * @return string
     */
    public function getMinimum()
    {
        return $this->minimum;
    }


    /**
     * @param string $minimum
     * @return QualityRange
     */
    public function setMinimum($minimum)
    {
        $this->minimum = $minimum;
        return $this;
    }

    /**
     * @return string $maximum
     */
    public function getMaximum()
    {
        return $this->maximum;
    }


    /**
     * @param string $maximum
     * @return QualityRange
     */
    public function setMaximum($maximum)
    {
        $this->maximum = $maximum;
        return $this;
    }

}