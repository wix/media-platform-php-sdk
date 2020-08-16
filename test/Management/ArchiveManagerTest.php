<?php


namespace Wix\Mediaplatform\Management;

use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Model\Job\Destination;
use Wix\Mediaplatform\Model\Job\Source;
use Wix\Mediaplatform\Model\Request\ExtractArchiveRequest;
use Wix\Mediaplatform\Model\Request\JobCallback;

class ArchiveManagerTest extends BaseTest
{
    /**
     * @var ArchiveManager
     */
    private static $archiveManager;

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
        self::$archiveManager = new ArchiveManager(BaseTest::$configuration, BaseTest::$authenticatedHttpClient);
    }

    public function testCreateArchive()
    {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "create-archive-pending-response.json");

        $createArchiveRequest = new \Wix\Mediaplatform\Model\Request\CreateArchiveRequest();

        $source = new \Wix\Mediaplatform\Model\Job\Source();
        $source->setFileId("file id");

        $destination = new \Wix\Mediaplatform\Model\Job\Destination();
        $destination->setAcl("public")
            ->setPath("/demo/file.zip");

        $jobCallback = new JobCallback();
        $jobCallback->setUrl("https://example.com/callback");

        $createArchiveRequest
            ->addSource($source)
            ->setDestination($destination)
	        ->setJobCallback($jobCallback)
	        ->setArchiveType('zip');

        $job = self::$archiveManager->createArchive($createArchiveRequest);

        $this->assertEquals("6b4da966844d4ae09417300f3811849b_dd0ecc5cbaba4f1b9aba08cc6fa7348b", $job->getId());
    }

    public function testExtractArchive()
    {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "extract-archive-pending-response.json");

        $source = new Source();
        $source->setFileId("file id");

        $destination = new Destination();
        $destination->setDirectory("/fish");

	    $jobCallback = new JobCallback();
	    $jobCallback->setUrl("https://example.com/callback");

	    $extractArchiveRequest = new ExtractArchiveRequest();
        $extractArchiveRequest
	        ->setJobCallback($jobCallback)
	        ->setSource($source)
	        ->setDestination($destination);

        $job = self::$archiveManager->extractArchive($extractArchiveRequest);

        $this->assertEquals("6b4da966844d4ae09417300f3811849b_dd0ecc5cbaba4f1b9aba08cc6fa7348b", $job->getId());
    }
}