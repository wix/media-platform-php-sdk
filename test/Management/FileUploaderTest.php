<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/05/2017
 * Time: 11:11
 */

namespace Wix\Mediaplatform\Management;

use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Model\Job\Destination;
use Wix\Mediaplatform\Model\Job\Source;
use Wix\Mediaplatform\Model\Request\CopyFileRequest;
use Wix\Mediaplatform\Model\Request\CreateFileRequest;
use Wix\Mediaplatform\Model\Request\ImportFileRequest;

class FileUploaderTest extends BaseTest
{
    /**
     * @var FileUploader
     */
    private static $fileUploader;

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
    }

    public function testCreateFile()
    {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "get-upload-url-response.json");
        $response = self::$fileUploader->getUploadUrl(null);

        $this->assertEquals("some token", $response->getUploadToken());
        $this->assertEquals("https://localhost:8443/_api/upload/file", $response->getUploadUrl());
    }


    public function testUploadFile() {
        self::setUpMockResponse(array("Content-Type" => "application/json"),
            array("get-upload-url-response.json", "file-upload-response.json")
        );


        $file = fopen(BaseTest::RESOURCES_DIR . DIRECTORY_SEPARATOR . "source/image.jpg", 'r');
        $files = self::$fileUploader->uploadFile("/a/new.txt", "text/plain", "new.txt", $file, null);

        $this->assertEquals("c4516b12744b4ef08625f016a80aed3a", $files[0]->getId());
    }

	public function testCopyFile() {
		self::setUpMockResponse(array("Content-Type" => "application/json"),
			"copy-file-response.json");

		$destination = new Destination();
		$destination->setAcl("public")
		            ->setDirectory("/foo");

		$source = new Source();
		$source->setPath('/bar/file.jpg');

		$copyFileRequest = new CopyFileRequest();
		$copyFileRequest->setSource($source)
			->setDestination($destination);

		$fileDescriptor = self::$fileUploader->copyFile($copyFileRequest);

		$this->assertEquals("/foo/file.jpg", $fileDescriptor->getPath());

	}


	public function testImportFilePending() {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "import-file-pending-response.json");
        $destination = new Destination();
        $destination->setAcl("public")
            ->setDirectory("/fish");

        $importFileRequest = new ImportFileRequest();
        $importFileRequest->setSourceUrl("http://source.url")
	        ->setJobCallback("https://example.com/callback")
	        ->setDestination($destination);
        $job = self::$fileUploader->importFile($importFileRequest);

        $this->assertEquals("71f0d3fde7f348ea89aa1173299146f8_19e137e8221b4a709220280b432f947f", $job->getId());
    }

    public function testImportFileSuccess(){
        self::setUpMockResponse(array("Content-Type" => "application/json"), "import-file-success-response.json");

        $destination = new Destination();
        $destination->setAcl("public")
            ->setDirectory("/fish");

        $importFileRequest = new ImportFileRequest();
        $importFileRequest->setSourceUrl("http://source.url")
	        ->setJobCallback("https://example.com/callback")
            ->setDestination($destination);
        $job = self::$fileUploader->importFile($importFileRequest);

        $this->assertEquals("71f0d3fde7f348ea89aa1173299146f8_19e137e8221b4a709220280b432f947f", $job->getId());
    }
}