<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 20:48
 */

namespace Wix\Mediaplatform\Management;


use Wix\Mediaplatform\Configuration\Configuration;
use Wix\Mediaplatform\Http\AuthenticatedHTTPClient;
use Wix\Mediaplatform\Model\Job\ExtractPostersJobResult;
use Wix\Mediaplatform\Model\Job\TranscodeJobResult;
use Wix\Mediaplatform\Model\Request\ExtractPostersRequest;
use Wix\Mediaplatform\Model\Request\TranscodeRequest;

/**
 * Class TranscodeManager
 * @package Wix\Mediaplatform\Management
 */
class TranscodeManager
{

    /**
     * @var AuthenticatedHTTPClient
     */
    private $authenticatedHttpClient;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * TranscodeManager constructor.
     * @param Configuration $configuration
     * @param AuthenticatedHTTPClient $authenticatedHttpClient
     */
    public function __construct(Configuration $configuration, AuthenticatedHTTPClient $authenticatedHttpClient)
    {
        $this->authenticatedHttpClient = $authenticatedHttpClient;

        $this->baseUrl = "https://" . $configuration->getDomain() . "/_api";
    }


    /**
     * Issue a transcode request
     * @param TranscodeRequest $transcodeRequest
     * @return TranscodeJobResult
     */
    public function transcodeVideo(TranscodeRequest $transcodeRequest) {
        $restResponse = $this->authenticatedHttpClient->post($this->baseUrl . "/av/transcode", $transcodeRequest);
        return new TranscodeJobResult($restResponse->getPayload());
    }

    public function extractPosters(ExtractPostersRequest $extractPostersRequest) {
	    $restResponse = $this->authenticatedHttpClient->post($this->baseUrl . "/av/posters", $extractPostersRequest);
	    return new ExtractPostersJobResult($restResponse->getPayload());
    }
}