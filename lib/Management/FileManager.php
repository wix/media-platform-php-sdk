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
use Wix\Mediaplatform\Model\Metadata\FileDescriptor;
use Wix\Mediaplatform\Model\Metadata\FileMetadata;
use Wix\Mediaplatform\Model\Request\CreateFileRequest;
use Wix\Mediaplatform\Model\Request\ImportFileRequest;
use Wix\Mediaplatform\Model\Request\ListFilesRequest;
use Wix\Mediaplatform\Model\Request\UploadUrlRequest;
use Wix\Mediaplatform\Model\Response\ListFilesResponse;
use Wix\Mediaplatform\Model\Response\RestResponse;
use Wix\Mediaplatform\Model\Response\Types;

/**
 * Class FileManager
 * @package Wix\Mediaplatform\Management
 */
class FileManager
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
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * FileManager constructor.
     * @param Configuration $configuration
     * @param AuthenticatedHTTPClient $authenticatedHttpClient
     * @param FileUploader $fileUploader
     */
    public function __construct(Configuration $configuration, AuthenticatedHTTPClient $authenticatedHttpClient, FileUploader $fileUploader)
    {
        $this->authenticatedHttpClient = $authenticatedHttpClient;

        $this->baseUrl = "https://" . $configuration->getDomain() . "/_api";

        $this->fileUploader = $fileUploader;
    }

    /**
     * @param UploadUrlRequest|null $uploadUrlRequest
     * @return mixed
     */
    public function getUploadUrl(UploadUrlRequest $uploadUrlRequest = null)
    {
        return $this->fileUploader->getUploadUrl($uploadUrlRequest);
    }

    /**
     * @param string $path
     * @param string $mimeType
     * @param string $fileName
     * @param string|resource $source
     * @param string|null $acl
     * @return array
     */
    public function uploadFile($path, $mimeType, $fileName, $source, $acl = null)
    {
        return $this->fileUploader->uploadFile($path, $mimeType, $fileName, $source, $acl);
    }

    /**
     * @param ImportFileRequest $importFileRequest
     * @return mixed
     */
    public function importFile(ImportFileRequest $importFileRequest)
    {
        return $this->fileUploader->importFile($importFileRequest);
    }

    /**
     * @param CreateFileRequest $createFileRequest
     * @return FileDescriptor
     */
    public function createFile(CreateFileRequest $createFileRequest)
    {
        /**
         * @var RestResponse $restResponse
         */
        $restResponse = $this->authenticatedHttpClient->post(
            $this->baseUrl . "/files",
            $createFileRequest
        );

        return new FileDescriptor($restResponse->getPayload());
    }

    /**
     * @param $path
     * @return mixed
     */
    public function getFile($path)
    {
        $params = array();
        $params["path"] = $path;

        /**
         * @var RestResponse $restResponse
         */
        $restResponse = $this->authenticatedHttpClient->get(
            $this->baseUrl . "/files",
            $params,
            Types::FILE_DESCRIPTOR_REST_RESPONSE);
        return $restResponse->getPayload();
    }

    /**
     * @param $fileId
     * @return mixed
     */
    public function getFileMetadataById($fileId)
    {
        /**
         * @var RestResponse $restResponse
         */
        $restResponse = $this->authenticatedHttpClient->get(
            $this->baseUrl . "/files/" . $fileId . "/metadata",
            null,
            Types::FILE_METADATA_REST_RESPONSE);

        return $restResponse->getPayload();
    }

    /**
     * @param $path
     * @param ListFilesRequest|null $listFilesRequest
     * @return mixed
     */
    public function listFiles($path, ListFilesRequest $listFilesRequest = null)
    {
        $params = array();
        if ($listFilesRequest != null) {
            array_merge($params, $listFilesRequest->toParams());
        }
        $params['path'] = $path;

        /**
         * @var RestResponse $restResponse
         */
        $restResponse = $this->authenticatedHttpClient->get(
            $this->baseUrl . "/files/ls_dir",
            $params,
            Types::FILE_LIST_REST_RESPONSE
        );
        return $restResponse->getPayload();
    }

    /**
     * @param $path
     */
    public function deleteFileByPath($path)
    {
        $params = array();
        $params["path"] = $path;
        $this->authenticatedHttpClient->delete($this->baseUrl . "/files", $params, null);
    }

    /**
     * @param $fileId
     */
    public function deleteFileById($fileId)
    {
        $this->authenticatedHttpClient->delete($this->baseUrl . "/files/" . $fileId, null, null);
    }
}