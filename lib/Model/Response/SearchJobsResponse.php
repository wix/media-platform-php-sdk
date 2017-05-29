<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:48
 */

namespace Wix\Mediaplatform\Model\Response;
use Wix\Mediaplatform\Management\JobManager;
use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class SearchJobsResponse
 * @package Wix\Mediaplatform\Model\Response
 */
class SearchJobsResponse extends BaseModel
{

    /**
     * @var string
     */
    protected $nextPageToken;

    /**
     * @var array[Job]
     */
    protected $jobs;

    public function __construct(Array $payload) {
        parent::__construct($payload);
        $this->jobs = array();
        if(is_array($payload['jobs']) && !empty($payload['jobs'])) {
            foreach($payload['jobs'] as $job) {
                $this->jobs[] = JobManager::createJobObjectFromPayload($job);
            }
        }

    }
    /**
     * @return string
     */
    public function getNextPageToken()
    {
        return $this->nextPageToken;
    }

    /**
     * @return array
     */
    public function getJobs()
    {
        return $this->jobs;
    }

}