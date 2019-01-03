<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 20:48
 */

namespace Wix\Mediaplatform\Management;


use SebastianBergmann\CodeCoverage\Node\File;
use Wix\Mediaplatform\Configuration\Configuration;
use Wix\Mediaplatform\Http\AuthenticatedHTTPClient;
use Wix\Mediaplatform\Model\Job\FileImportJob;
use Wix\Mediaplatform\Model\Metadata\FileDescriptor;
use Wix\Mediaplatform\Model\Metadata\FileMetadata;
use Wix\Mediaplatform\Model\Request\CopyFileRequest;
use Wix\Mediaplatform\Model\Request\CreateFileRequest;
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
     * @return GetUploadUrlResponse
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
     * @param array $options
     * @return array
     */
    public function uploadFile($path, $mimeType, $fileName, $source, $acl = null, $options = [])
    {
        return $this->fileUploader->uploadFile($path, $mimeType, $fileName, $source, $acl, $options);
    }

    /**
     * @param ImportFileRequest $importFileRequest
     * @return FileImportJob
     */
    public function importFile(ImportFileRequest $importFileRequest)
    {
        return $this->fileUploader->importFile($importFileRequest);
    }


	/**
	 * @param CopyFileRequest $copyFileRequest
	 * @return FileDescriptor
	 */
    public function copyFile(CopyFileRequest $copyFileRequest)
    {
    	return $this->fileUploader->copyFile($copyFileRequest);
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
     * @return FileDescriptor
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
            $params
        );
        return new FileDescriptor($restResponse->getPayload());
    }

    /**
     * @param $fileId
     * @return FileMetadata
     */
    public function getFileMetadataById($fileId)
    {
        /**
         * @var RestResponse $restResponse
         */
        $restResponse = $this->authenticatedHttpClient->get(
            $this->baseUrl . "/files/" . $fileId . "/metadata"
        );

        return new FileMetadata($restResponse->getPayload());
    }

    /**
     * @param $path
     * @param ListFilesRequest|null $listFilesRequest
     * @return ListFilesResponse
     */
    public function listFiles($path, ListFilesRequest $listFilesRequest = null)
    {
        $params = array();
        if ($listFilesRequest != null) {
            $params = $listFilesRequest->toParams();
        }
        $params['path'] = $path;

        /**
         * @var RestResponse $restResponse
         */
        $restResponse = $this->authenticatedHttpClient->get(
            $this->baseUrl . "/files/ls_dir",
            $params
        );
        return new ListFilesResponse($restResponse->getPayload());
    }

    /**
     * @param $path
     */
    public function deleteFileByPath($path)
    {
        $params = array();
        $params["path"] = $path;
        $this->authenticatedHttpClient->delete($this->baseUrl . "/files", $params);
    }

    /**
     * @param $fileId
     */
    public function deleteFileById($fileId)
    {
        $this->authenticatedHttpClient->delete($this->baseUrl . "/files/" . $fileId);
    }


    /**
     * @param null $path
     * @param null $id
     * @param null $acl
     * @return FileDescriptor
     */
    public function updateFileAcl($path = null, $id = null, $acl = null) {
        if((!is_null($path) || !is_null($id)) && !is_null($acl) ) {
            $restResponse = $this->authenticatedHttpClient->put(
                $this->baseUrl . "/files",
                array(
                    "path" => $path,
                    "id" => $id,
                    "acl" => $acl
                )
            );
            return new FileDescriptor($restResponse->getPayload());
        } else {
            return null;
        }
    }

    /**
     * @param $path
     * @return FileMetadata
     */
    public function getFileDigest($path) {
        $restResponse = $this->authenticatedHttpClient->get(
            $this->baseUrl . "/digest",
            array(
                "path" => $path,
            )
        );

        return new FileMetadata($restResponse->getPayload());
    }

}