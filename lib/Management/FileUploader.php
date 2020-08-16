<?php
namespace Wix\Mediaplatform\Management;


use Wix\Mediaplatform\Configuration\Configuration;
use Wix\Mediaplatform\Http\AuthenticatedHTTPClient;
use Wix\Mediaplatform\Model\Job\FileImportJob;
use Wix\Mediaplatform\Model\Metadata\FileDescriptor;
use Wix\Mediaplatform\Model\Request\CopyFileRequest;
use Wix\Mediaplatform\Model\Request\ImportFileRequest;
use Wix\Mediaplatform\Model\Request\UploadConfigurationRequest;
use Wix\Mediaplatform\Model\Response\GetUploadConfigurationResponse;

class FileUploader
{
    /**
     * @var AuthenticatedHttpClient
     */
    private $authenticatedHTTPClient;

      /**
     * @var string
     */
    private $apiBaseUrl;
	private $getUploadConfigurationUrl;

	/**
     * FileUploader constructor.
     * @param Configuration $configuration
     * @param AuthenticatedHTTPClient $authenticatedHTTPClient
     */
    public function __construct(Configuration $configuration, AuthenticatedHTTPClient $authenticatedHTTPClient) {
        $this->authenticatedHTTPClient = $authenticatedHTTPClient;

        $this->apiBaseUrl = "https://" . $configuration->getDomain() . "/_api";
	    $this->getUploadConfigurationUrl = $this->apiBaseUrl . "/v3/upload/configuration";
    }

	/**
	 * @param UploadConfigurationRequest $uploadConfigurationRequest
	 *
	 * @return GetUploadConfigurationResponse
	 */
    public function getUploadConfiguration(UploadConfigurationRequest $uploadConfigurationRequest = null) {
        $params = null;
        if ($uploadConfigurationRequest != null) {
            $params = $uploadConfigurationRequest->toArray();
        }

        $restResponse = $this->authenticatedHTTPClient->post(
            $this->getUploadConfigurationUrl,
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
    public function uploadFile($path, $mimeType, $fileName, $source, $acl = null, $options = []) {
	    $uploadConfigurationRequest = new UploadConfigurationRequest();
        $uploadConfigurationRequest->setMimeType($mimeType)
	        ->setAcl($acl)
            ->setPath($path)
        ;
	    $uploadConfigurationResponse = $this->getUploadConfiguration($uploadConfigurationRequest);

        $form = $this->prepareForm($path, $mimeType, $acl);

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
        if (is_array($payload) && !empty($payload)) {
            $response[] = new FileDescriptor($payload);
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
    private function prepareForm($path, $mimeType, $acl = null) {
        $multipart = array();
        $multipart[] = array("name" => "path", "contents" => $path);
        $multipart[] = array("name" => "mimeType", "contents" => $mimeType);
        if ($acl != null) {
            $multipart[] = array("name" => "acl", "contents" => $acl);
        }

        return $multipart;
    }
}