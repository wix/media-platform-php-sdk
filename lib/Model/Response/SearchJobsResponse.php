<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:48
 */

namespace Wix\Mediaplatform\Model\Response;


/**
 * Class SearchJobsResponse
 * @package Wix\Mediaplatform\Model\Response
 */
class SearchJobsResponse extends BaseResponse
{

    /**
     * @var string
     */
    protected $nextPageToken;

    /**
     * @var array[Job]
     */
    protected $jobs;

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