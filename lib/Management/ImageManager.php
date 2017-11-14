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
use Wix\Mediaplatform\Model\Metadata\Features\ImageFeatures;
use Wix\Mediaplatform\Model\Metadata\FileDescriptor;
use Wix\Mediaplatform\Model\Metadata\FileMetadata;
use Wix\Mediaplatform\Model\Request\CreateFileRequest;
use Wix\Mediaplatform\Model\Request\ExtractImageFeaturesRequest;
use Wix\Mediaplatform\Model\Request\ImportFileRequest;
use Wix\Mediaplatform\Model\Request\ListFilesRequest;
use Wix\Mediaplatform\Model\Request\UploadUrlRequest;
use Wix\Mediaplatform\Model\Response\GetUploadUrlResponse;
use Wix\Mediaplatform\Model\Response\ListFilesResponse;
use Wix\Mediaplatform\Model\Response\RestResponse;

/**
 * Class FileManager
 * @package Wix\Mediaplatform\Management
 */
class ImageManager
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
     * ImageManager constructor.
     * @param Configuration $configuration
     * @param AuthenticatedHTTPClient $authenticatedHttpClient
     * @param FileUploader $fileUploader
     */
    public function __construct(Configuration $configuration, AuthenticatedHTTPClient $authenticatedHttpClient)
    {
        $this->authenticatedHttpClient = $authenticatedHttpClient;

        $this->baseUrl = "https://" . $configuration->getDomain() . "/_api";
    }


    /**
     * @param ExtractImageFeaturesRequest $extractImageFeaturesRequest
     * @return ImageFeatures
     */
    public function extractFeatures(ExtractImageFeaturesRequest $extractImageFeaturesRequest) {
        /**
         * @var RestResponse $restResponse
         */
        $restResponse = $this->authenticatedHttpClient->get(
            $this->baseUrl . "/images/features",
            $extractImageFeaturesRequest->toParams()
        );

        return new ImageFeatures($restResponse->getPayload());
    }


}