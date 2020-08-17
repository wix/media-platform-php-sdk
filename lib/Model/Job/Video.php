<?php


namespace Wix\Mediaplatform\Model\Job;

use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class Video
 * @package Wix\Mediaplatform\Model\Job
 */
class Video extends BaseModel
{
    /**
     * @var VideoSpecification
     */
    protected $specification;

    /**
     * Video constructor.
     */
    public function __construct(Array $payload = null) {
        parent::__construct($payload);
        if($payload && !empty($payload['specification'])) {
            $this->specification = new VideoSpecification($payload['specification']);
        }
    }

    /**
     * @return VideoSpecification
     */
    public function getSpecification()
    {
        return $this->specification;
    }

    /**
     * @param VideoSpecification $specification
     * @return Video
     */
    public function setSpecification(VideoSpecification $specification)
    {
        $this->specification = $specification;
        return $this;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return "Video{" .
            "specification=" . $this->specification .
            '}';
    }
}