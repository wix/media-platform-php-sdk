<?php


namespace Wix\Mediaplatform\Model\Job;
use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class Audio
 * @package Wix\Mediaplatform\Model\Job
 */
class Audio extends BaseModel
{
    /**
     * @var AudioSpecification
     */
    protected $specification;

    /**
     * Audio constructor.
     */
    public function __construct(Array $payload = null) {
        parent::__construct($payload);
        if($payload && !empty($payload['specification'])) {
            $this->specification = new AudioSpecification($payload['specification']);
        }
    }
    /**
     * @return AudioSpecification
     */
    public function getSpecification()
    {
        return $this->specification;
    }

    /**
     * @param AudioSpecification $specification
     * @return Audio
     */
    public function setSpecification(AudioSpecification $specification)
    {
        $this->specification = $specification;
        return $this;
    }



    /**
     * @return string
     */
    public function __toString()
    {
        return "Audio{" .
            "specification=" . $this->specification .
            '}';
    }
}