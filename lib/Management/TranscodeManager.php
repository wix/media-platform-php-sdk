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
use Wix\Mediaplatform\Model\Job\FileImportJob;
use Wix\Mediaplatform\Model\Job\TranscodeJobResult;
use Wix\Mediaplatform\Model\Metadata\FileDescriptor;
use Wix\Mediaplatform\Model\Metadata\FileMetadata;
use Wix\Mediaplatform\Model\Request\CreateFileRequest;
use Wix\Mediaplatform\Model\Request\ImportFileRequest;
use Wix\Mediaplatform\Model\Request\ListFilesRequest;
use Wix\Mediaplatform\Model\Request\TranscodeRequest;
use Wix\Mediaplatform\Model\Request\UploadUrlRequest;
use Wix\Mediaplatform\Model\Response\GetUploadUrlResponse;
use Wix\Mediaplatform\Model\Response\ListFilesResponse;
use Wix\Mediaplatform\Model\Response\RestResponse;
use Wix\Mediaplatform\Model\Response\Types;

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
}