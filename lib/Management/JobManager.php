<?php


namespace Wix\Mediaplatform\Management;


use Wix\Mediaplatform\Configuration\Configuration;
use Wix\Mediaplatform\Http\AuthenticatedHTTPClient;
use Wix\Mediaplatform\Model\Job\ExtractPostersJob;
use Wix\Mediaplatform\Model\Job\FileImportJob;
use Wix\Mediaplatform\Model\Job\Job;
use Wix\Mediaplatform\Model\Job\TranscodeJob;
use Wix\Mediaplatform\Model\Request\SearchJobsRequest;
use Wix\Mediaplatform\Model\Response\RestResponse;
use Wix\Mediaplatform\Model\Response\SearchJobsResponse;
use Wix\Mediaplatform\Model\Response\Types;

class JobManager
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var AuthenticatedHTTPClient
     */
    private $authenticatedHTTPClient;

    /**
     * @var string
     */
    private $apiBaseUrl;

    /**
     * JobManager constructor.
     * @param Configuration $configuration
     * @param AuthenticatedHTTPClient $authenticatedHTTPClient
     */
    public function __construct(Configuration $configuration, AuthenticatedHTTPClient $authenticatedHTTPClient) {
        $this->configuration = $configuration;

        $this->apiBaseUrl = "https://" . $configuration->getDomain() . "/_api";

        $this->authenticatedHTTPClient = $authenticatedHTTPClient;
    }

    /**
     * @param array $payload
     * @return FileImportJob|TranscodeJob|ExtractPostersJob|null
     */
    public static function createJobObjectFromPayload(Array $payload = array()) {
        if(!empty($payload['type'])) {
            if($payload['type'] == FileImportJob::$job_type) {
                return new FileImportJob($payload);
            } elseif($payload['type'] == TranscodeJob::$job_type) {
                return new TranscodeJob($payload);
            }  elseif($payload['type'] == ExtractPostersJob::$job_type) {
                return new ExtractPostersJob($payload);
            }
        }
    }

    /**
     * @param array $payload
     * @return array
     */
    public static function createJobsGroupObjectFromPayload(Array $payload = array()) {
        $jobs = array();
        if(!empty($payload)) {
            foreach($payload as $job) {
                if(is_array($job) && !empty($job)) {
                    $jobs[] = self::createJobObjectFromPayload($job);
                }
            }
        }

        return $jobs;
    }

    /**
     * @param string $jobId
     * @return Job
     */
    public function getJob($jobId) {
        /**
         *
         * @var RestResponse $restResponse
         */
        $restResponse = $this->authenticatedHTTPClient->get(
            $this->apiBaseUrl . "/jobs/" . $jobId
        );

        return self::createJobObjectFromPayload($restResponse->getPayload());
    }

    /**
     * @param string $groupId
     * @return mixed
     */
    public function getJobGroup($groupId) {
        /**
         * @var RestResponse $restResponse
         */
        $restResponse = $this->authenticatedHTTPClient->get(
            $this->apiBaseUrl . "/jobs/groups/" . $groupId,
            null,
            Types::JOBS_REST_RESPONSE);

        return self::createJobsGroupObjectFromPayload($restResponse->getPayload());
    }

    /**
     * @param SearchJobsRequest $searchJobsRequest
     * @return SearchJobsResponse
     */
    public function searchJobs(SearchJobsRequest $searchJobsRequest) {
        $params = array();
        if ($searchJobsRequest != null) {
            $params = array_merge($params, $searchJobsRequest->toParams());
        }

        /**
         * @var RestResponse $restResponse
         */
        $restResponse = $this->authenticatedHTTPClient->get(
            $this->apiBaseUrl . "/jobs",
            $params,
            Types::SEARCH_JOBS_REST_RESPONSE);

        return new SearchJobsResponse($restResponse->getPayload());
    }
}