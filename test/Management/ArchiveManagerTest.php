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
use Wix\Mediaplatform\Model\Job\ExtractArchiveJob;
use Wix\Mediaplatform\Model\Job\Source;
use Wix\Mediaplatform\Model\Request\CreateFileRequest;
use Wix\Mediaplatform\Model\Request\ExtractArchiveRequest;

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

    public function testExtractArchive()
    {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "extract-archive-pending-response.json");

        $source = new Source();
        $source->setFileId("file id");

        $destination = new Destination();
        $destination->setDirectory("/fish");

        $extractArchiveRequest = new ExtractArchiveRequest();
        $extractArchiveRequest->setSource($source)->setDestination($destination);

        $job = self::$archiveManager->extractArchive($extractArchiveRequest);

        $this->assertEquals("6b4da966844d4ae09417300f3811849b_dd0ecc5cbaba4f1b9aba08cc6fa7348b", $job->getId());
    }
}