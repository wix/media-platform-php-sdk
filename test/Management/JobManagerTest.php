<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/05/2017
 * Time: 11:11
 */

namespace Wix\Mediaplatform\Management;

use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Model\Job\Destination;
use Wix\Mediaplatform\Model\Request\CreateFileRequest;
use Wix\Mediaplatform\Model\Request\ImportFileRequest;
use Wix\Mediaplatform\Model\Request\SearchJobsRequest;

class JobManagerTest extends BaseTest
{
    /**
     * @var JobManager
     */
    private static $jobManager;

    /**
     * Setup before running any test case
     */
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
    }

    public static function setUpMockResponse($headers, $mockResponseFile)
    {
        parent::setUpMockResponse($headers, $mockResponseFile);
        self::$jobManager = new JobManager(BaseTest::$configuration, BaseTest::$authenticatedHttpClient);
    }

    public function testGetJob()
    {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "get-job-response.json");
        $job = self::$jobManager->getJob("71f0d3fde7f348ea89aa1173299146f8_19e137e8221b4a709220280b432f947f");

        $this->assertEquals("71f0d3fde7f348ea89aa1173299146f8_19e137e8221b4a709220280b432f947f", $job->getId());
    }


    public function testGetJobs() {
        self::setUpMockResponse(array("Content-Type" => "application/json"),"get-job-group-response.json");

        $jobs = self::$jobManager->getJobGroup("71f0d3fde7f348ea89aa1173299146f8");

        $this->assertEquals("71f0d3fde7f348ea89aa1173299146f8_19e137e8221b4a709220280b432f947f", $jobs[0]->getId());
    }


    public function testSearchJobs() {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "search-jobs-response.json");
        $searchJobsRequest = new SearchJobsRequest();
        $searchJobsRequest->setGroupId("71f0d3fde7f348ea89aa1173299146f8");

        $response = self::$jobManager->searchJobs($searchJobsRequest);

        $this->assertEquals("71f0d3fde7f348ea89aa1173299146f8_19e137e8221b4a709220280b432f947f", $response->getJobs()[0]->getId());
    }
}