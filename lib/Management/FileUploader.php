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
use Wix\Mediaplatform\Model\Request\UploadConfigurationRequest;
use Wix\Mediaplatform\Model\Request\UploadUrlRequest;
use Wix\Mediaplatform\Model\Response\GetUploadConfigurationResponse;
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

    private function uploadConfigurationEndpoint($version="v2") {
	    return  $this->apiBaseUrl . "/" . $version . "/upload/configuration";
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
	 * @param UploadConfigurationRequest $uploadConfigurationRequest
	 * @param string $version
	 *
	 * @return GetUploadConfigurationResponse
	 */
    public function getUploadConfiguration(UploadConfigurationRequest $uploadConfigurationRequest = null, $version = "v2") {
        $params = null;
        if ($uploadConfigurationRequest != null) {
            $params = $uploadConfigurationRequest->toArray();
        }

        $restResponse = $this->authenticatedHTTPClient->post(
            $this->uploadConfigurationEndpoint($version),
            $params);

        return new GetUploadConfigurationResponse($restResponse->getPayload());
    }

	/**
	 * @param string $path
	 * @param string $mimeType
	 * @param string $fileName
	 * @param string|resource $source
	 * @param string|null $acl
	 * @param array $options
	 *
	 * @return array
	 */
    public function uploadFileV3($path, $mimeType, $fileName, $source, $acl = null, $options = []) {
    	return $this->uploadFile($path, $mimeType, $fileName, $source, $acl, $options, "v3");
    }

	/**
	 * @param string $path
	 * @param string $mimeType
	 * @param string $fileName
	 * @param string|resource $source
	 * @param string|null $acl
	 * @param array $options
	 * @param string $version
	 *
	 * @return array
	 */
    public function uploadFile($path, $mimeType, $fileName, $source, $acl = null, $options = [], $version = "v2") {
        /**
         * @var UploadConfigurationRequest $uploadConfigurationRequest
         **/
        $uploadConfigurationRequest = new UploadConfigurationRequest();
        $uploadConfigurationRequest->setMimeType($mimeType)
	        ->setAcl($acl)
            ->setPath($path)
        ;
        /**
         * @var GetUploadConfigurationResponse $uploadConfigurationResponse
         */
        $uploadConfigurationResponse = $this->getUploadConfiguration($uploadConfigurationRequest, $version);

        $form = $this->prepareForm($path, $mimeType, $uploadConfigurationResponse->getUploadToken(), $acl);

        if(is_string($source)) {
            // file path
            $form[] = array("name" => $fileName, "contents" => fopen($source, "r"));
        } elseif(is_resource($source)) {
            // resource stream
            $form[] = array("name" => $fileName, "contents" => $source);
        }

        $options['multipart'] = $form;

        $restResponse = $this->authenticatedHTTPClient->post(
            $uploadConfigurationResponse->getUploadUrl(),
            array(),
            $options
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
	 * @param $uploadToken
	 * @param string|null $acl
	 *
	 * @return array
	 */
    private function prepareForm($path, $mimeType, $uploadToken, $acl = null) {
        $multipart = array();
        $multipart[] = array("name" => "path", "contents" => $path);
        $multipart[] = array("name" => "uploadToken", "contents" => $uploadToken);
        $multipart[] = array("name" => "mimeType", "contents" => $mimeType);
        if ($acl != null) {
            $multipart[] = array("name" => "acl", "contents" => $acl);
        }

        return $multipart;
    }
}