<?php


namespace Wix\Mediaplatform\Model\Job;


use Wix\Mediaplatform\Model\BaseModel;

/**
 * Class ExtractPostersJobResult
 * @package Wix\Mediaplatform\Model\Job
 */
class ExtractPostersJobResult extends BaseModel
{
    /**
     * @var array
     */
    protected $jobs;

    /**
     * @var string
     */
    protected $groupId;

    /**
     * TranscodeJobResult constructor.
     * @param array $payload
     */
    public function __construct(Array $payload) {
        parent::__construct($payload);
        if($payload && !empty($payload['jobs'])) {
            $this->jobs = array();
            foreach($payload['jobs'] as $job) {
                $this->jobs[] = new TranscodeJob($job);
            }
        }
    }

    /**
     * @return array
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * @return string
     */
    public function getGroupId()
    {
        return $this->groupId;
    }


     /**
     * @return string
     */
    public function __toString()
    {
        return "ExtractPostersJobResult{" .
            "jobs=" . $this->jobs .
            ", groupId=" . $this->groupId .
            '}';
    }
}