<?php


namespace Wix\Mediaplatform\Management;

use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Model\Job\Destination;
use Wix\Mediaplatform\Model\Job\QualityRange;
use Wix\Mediaplatform\Model\Job\Source;
use Wix\Mediaplatform\Model\Job\TranscodeSpecification;
use Wix\Mediaplatform\Model\Request\JobCallback;
use Wix\Mediaplatform\Model\Request\TranscodeRequest;

class TranscodeManagerTest extends BaseTest
{
    /**
     * @var TranscodeManager
     */
    private static $transcodeManager;

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
        self::$transcodeManager = new TranscodeManager(BaseTest::$configuration, BaseTest::$authenticatedHttpClient);
    }

    public function testTranscodeVideo()
    {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "transcode-response.json");
        $transcodeRequest = new TranscodeRequest();

        $specifications = array(
            TranscodeSpecification::factory()
                ->setDestination(
                    Destination::factory()
                        ->setDirectory("/test/output1.mp4")
                        ->setAcl("public")
                )->setQualityRange(
                    QualityRange::factory()
                        ->setMinimum("240p")
                        ->setMaximum("1440p")
                )
        );

        $source = Source::factory()->setPath("/test/file.mp4");

	    $jobCallback = new JobCallback();
	    $jobCallback->setUrl("https://example.com/callback");

	    $transcodeRequest->addSource($source)
	        ->setJobCallback($jobCallback)
            ->setSpecifications($specifications);

        $transcodeResponse = self::$transcodeManager->transcodeVideo($transcodeRequest);
        $this->assertEquals("fb79405a16434aab87ccbd1384563033", $transcodeResponse->getGroupId() );
    }


}