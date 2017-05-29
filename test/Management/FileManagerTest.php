<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/05/2017
 * Time: 11:11
 */

namespace Wix\Mediaplatform\Management;

use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Model\Request\CreateFileRequest;

class FileManagerTest extends BaseTest
{
    /**
     * @var FileUploader
     */
    private static $fileUploader;

    /**
     * @var FileManager
     */
    private static $fileManager;

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
        self::$fileUploader = new FileUploader(BaseTest::$configuration, BaseTest::$authenticatedHttpClient);
        self::$fileManager = new FileManager(BaseTest::$configuration, BaseTest::$authenticatedHttpClient, self::$fileUploader);
    }

    public function testCreateFile()
    {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "file-descriptor-response.json");
        $createFileRequest = new CreateFileRequest();
        $createFileRequest->setPath("/");
        $fileDescriptor = self::$fileManager->createFile($createFileRequest);
        $this->assertEquals("d0e18fd468cd4e53bc2bbec3ca4a8676", $fileDescriptor->getId());
    }

    public function testGetFile()
    {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "file-descriptor-response.json");
        $file = self::$fileManager->getFile("/file.txt");

        $this->assertEquals("d0e18fd468cd4e53bc2bbec3ca4a8676", $file->getId());
    }

    public function testGetFileMetadataByIdImage() {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "file-metadata-image-response.json");

        $file = self::$fileManager->getFileMetadataById("id");

        $this->assertEquals("2145ae56cd5c47c79c05d4cfef5f1078", $file->getFileDescriptor()->getId());
    }

    public function testGetFileMetadataByIdVideo() {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "file-metadata-video-response.json");

        $file = self::$fileManager->getFileMetadataById("id");

        $this->assertEquals("2de4305552004e0b9076183651030646", $file->getFileDescriptor()->getId());
    }
    public function testListFiles() {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "list-files-response.json");
        $response = self::$fileManager->listFiles("/", null);

        $this->assertEquals(2, count($response->getFiles()));
    }

    public function testDeleteFileById() {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "null-payload-response.json");
        self::$fileManager->deleteFileById("fileId");
        $this->addToAssertionCount(1);
    }

    public function testDeleteFileByPath() {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "null-payload-response.json");
        self::$fileManager->deleteFileByPath("/file.txt");
        $this->addToAssertionCount(1);

    }
}