<?php


namespace Wix\Mediaplatform\Management;

use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Model\Job\Destination;
use Wix\Mediaplatform\Model\Job\Source;
use Wix\Mediaplatform\Model\Request\CopyFileRequest;
use Wix\Mediaplatform\Model\Request\ImportFileRequest;
use Wix\Mediaplatform\Model\Request\JobCallback;
use Wix\Mediaplatform\Model\Request\UploadConfigurationRequest;

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

	public function testGetUploadConfigurationSuccess() {
		self::setUpMockResponse(array("Content-Type" => "application/json"), "get-upload-configuration-response.json");

		$uploadConfigurationRequest = new UploadConfigurationRequest();
		$response = self::$fileUploader->getUploadConfiguration($uploadConfigurationRequest);
		$this->assertEquals("https://upload.wixmp.com/upload/ABCDEFGHIJKLMNOPQRSTUVWXYZ.1234567890.ABCDEFGHIJKLMNOPQRSTUVWXYZ", $response->getUploadUrl());
	}

    public function testUploadFile() {
        self::setUpMockResponse(array("Content-Type" => "application/json"),
            array("get-upload-configuration-response.json", "file-upload-response.json")
        );

        $file = fopen(BaseTest::RESOURCES_DIR . DIRECTORY_SEPARATOR . "source/image.jpg", 'r');
        $files = self::$fileUploader->uploadFile("/a/new.txt", "text/plain", $file, null, array());

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

		$jobCallback = new JobCallback();
		$jobCallback->setUrl("https://example.com/callback");

		$importFileRequest = new ImportFileRequest();
        $importFileRequest->setSourceUrl("http://source.url")
	        ->setJobCallback($jobCallback)
	        ->setDestination($destination);
        $job = self::$fileUploader->importFile($importFileRequest);

        $this->assertEquals("71f0d3fde7f348ea89aa1173299146f8_19e137e8221b4a709220280b432f947f", $job->getId());
    }

    public function testImportFileSuccess(){
        self::setUpMockResponse(array("Content-Type" => "application/json"), "import-file-success-response.json");

        $destination = new Destination();
        $destination->setAcl("public")
            ->setDirectory("/fish");

	    $jobCallback = new JobCallback();
	    $jobCallback->setUrl("https://example.com/callback");

	    $importFileRequest = new ImportFileRequest();
        $importFileRequest->setSourceUrl("http://source.url")
	        ->setJobCallback($jobCallback)
            ->setDestination($destination);
        $job = self::$fileUploader->importFile($importFileRequest);

        $this->assertEquals("71f0d3fde7f348ea89aa1173299146f8_19e137e8221b4a709220280b432f947f", $job->getId());
    }
}