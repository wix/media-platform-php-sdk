<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 21:08
 */

namespace Wix\Mediaplatform\Management;


use Wix\Mediaplatform\Configuration\Configuration;
use Wix\Mediaplatform\Http\AuthenticatedHTTPClient;
use Wix\Mediaplatform\Model\Job\FileImportJob;
use Wix\Mediaplatform\Model\Metadata\FileDescriptor;
use Wix\Mediaplatform\Model\Request\CopyFileRequest;
use Wix\Mediaplatform\Model\Request\ImportFileRequest;
use Wix\Mediaplatform\Model\Request\UploadUrlRequest;
use Wix\Mediaplatform\Model\Response\GetUploadUrlResponse;

class FileUploader
{
    /**
     * @var AuthenticatedHttpClient
     */
    private $authenticatedHTTPClient;

    /**
     * @var string
     */
    private $uploadUrlEndpoint;

    /**
     * @var string
     */
    private $apiBaseUrl;

    /**
     * FileUploader constructor.
     * @param Configuration $configuration
     * @param AuthenticatedHTTPClient $authenticatedHTTPClient
     */
    public function __construct(Configuration $configuration, AuthenticatedHTTPClient $authenticatedHTTPClient) {
        $this->authenticatedHTTPClient = $authenticatedHTTPClient;

        $this->apiBaseUrl = "https://" . $configuration->getDomain() . "/_api";

        $this->uploadUrlEndpoint = "https://" . $configuration->getDomain() . "/_api/upload/url";
    }

    /**
     * @param UploadUrlRequest $uploadUrlRequest
     * @return GetUploadUrlResponse
     */
    public function getUploadUrl(UploadUrlRequest $uploadUrlRequest = null) {
        $params = null;
        if ($uploadUrlRequest != null) {
            $params = $uploadUrlRequest->toParams();
        }

        $restResponse = $this->authenticatedHTTPClient->get(
            $this->uploadUrlEndpoint,
            $params);

        return new GetUploadUrlResponse($restResponse->getPayload());
    }

    /**
     * @param string $path
     * @param string $mimeType
     * @param string $fileName
     * @param string|resource $source
     * @param string|null $acl
     * @return array
     */
    public function uploadFile($path, $mimeType, $fileName, $source, $acl = null) {
        /**
         * @var UploadUrlRequest $uploadUrlRequest
         **/
        $uploadUrlRequest = new UploadUrlRequest();
        $uploadUrlRequest->setMimeType($mimeType)
            ->setPath($path);
        /**
         * @var GetUploadUrlResponse $uploadUrlResponse
         */
        $uploadUrlResponse = $this->getUploadUrl($uploadUrlRequest);

        $form = $this->prepareForm($path, $mimeType, $acl, $uploadUrlResponse);

        if(is_string($source)) {
            // file path
            $form[] = array("name" => $fileName, "contents" => fopen($source, "r"));
        } elseif(is_resource($source)) {
            // resource stream
            $form[] = array("name" => $fileName, "contents" => $source);
        }

        $restResponse = $this->authenticatedHTTPClient->post(
            $uploadUrlResponse->getUploadUrl(),
            array(),
            array("multipart" => $form)
        );

        $payload = $restResponse->getPayload();
        $response = array();
        if(is_array($payload) && !empty($payload)) {
            foreach($payload as $file) {
                $response[] = new FileDescriptor($file);
            }
        }

        return $response;
    }

    /**
     * @param ImportFileRequest $importFileRequest
     * @return FileImportJob
     */
    public function importFile(ImportFileRequest $importFileRequest) {
        $restResponse = $this->authenticatedHTTPClient->post(
            $this->apiBaseUrl . "/import/file",
            $importFileRequest
        );

        return JobManager::createJobObjectFromPayload($restResponse->getPayload());
    }

    /**
     * @param CopyFileRequest $copyFileRequest
     * @return FileDescriptor
     */
    public function copyFile(CopyFileRequest $copyFileRequest) {
	    $restResponse = $this->authenticatedHTTPClient->post(
		    $this->apiBaseUrl . "/copy/file",
		    $copyFileRequest
	    );

	    return new FileDescriptor($restResponse->getPayload());
    }

    /**
     * @param string $path
     * @param string $mimeType
     * @param string|null $acl
     * @param GetUploadUrlResponse $uploadUrlResponse
     * @return array
     */
    private function prepareForm($path, $mimeType, $acl = null, GetUploadUrlResponse $uploadUrlResponse) {
        $multipart = array();
        $multipart[] = array("name" => "path", "contents" => $path);
        $multipart[] = array("name" => "uploadToken", "contents" => $uploadUrlResponse->getUploadToken());
        $multipart[] = array("name" => "mimeType", "contents" => $mimeType);
        if ($acl != null) {
            $multipart[] = array("name" => "acl", "contents" => $acl);
        }

        return $multipart;
    }
}