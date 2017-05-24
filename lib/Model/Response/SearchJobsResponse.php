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
class SearchJobsResponse
{

    /**
     * @var string
     */
    private $nextPageToken;

    /**
     * @var array[Job]
     */
    private $jobs;

    /**
     * SearchJobsResponse constructor.
     */
    public function __construct()
    {
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