<?php


namespace Wix\Mediaplatform\Management;

use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Image\Image;
use Wix\Mediaplatform\Model\Job\Destination;
use Wix\Mediaplatform\Model\Job\ImageOperationSpecification;
use Wix\Mediaplatform\Model\Job\ImageWatermarkSpecification;
use Wix\Mediaplatform\Model\Job\Source;
use Wix\Mediaplatform\Model\Request\Enum\ImageWatermarkPosition;
use Wix\Mediaplatform\Model\Request\ExtractImageFeaturesRequest;
use Wix\Mediaplatform\Model\Request\ImageOperationRequest;
use Wix\Mediaplatform\Model\Request\ImageWatermarkRequest;

class ImageManagerTest extends BaseTest
{
    /**
     * @var ImageManager
     */
    private static $imageManager;

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
        self::$imageManager = new ImageManager(BaseTest::$configuration, BaseTest::$authenticatedHttpClient);
    }

    public function testImageFeatures()
    {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "image-features-response.json");

        $extractFeaturesRequest = new ExtractImageFeaturesRequest();
        $extractFeaturesRequest->setPath('/test.jpg');

        $imageFeatures = self::$imageManager->extractFeatures($extractFeaturesRequest);
        $this->assertEquals("violence", $imageFeatures->getExplicitContent()[0]->getName());
    }

    public function testImageOperation() {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "image-operation-response.json");

        $source = new Source();
        $source->setPath("/test.jpg");

        $destination = new Destination();
        $destination->setPath('/image/file/outputs/first.jpg');
        $destination->setAcl('public');

        $image = new Image();

        $image->fit(100, 100);
        $specification = new ImageOperationSpecification();
        $specification->setCommand($image);
        $specification->setDestination($destination);

        $imageOperationRequest = new ImageOperationRequest();
        $imageOperationRequest->setSource($source);
        $imageOperationRequest->setSpecification($specification);

        $fileDescriptor = self::$imageManager->imageOperation($imageOperationRequest);


        $this->assertEquals("/image/file/outputs/first.jpg", $fileDescriptor->getPath());
    }

    public function testImageWatermark() {
        self::setUpMockResponse(array("Content-Type" => "application/json"), "image-watermark-response.json");
        // 0f5781ad96c8413880c7b867bcccbba6

        $source = new Source();
        $source->setPath("/image/path/file.jpg");

        $watermarkSource = new Source();
        $watermarkSource->setPath("/image/watermark/file.png");

        $specification = new ImageWatermarkSpecification();
        $specification->setWatermark($watermarkSource);
        $specification->setPosition(ImageWatermarkPosition::SOUTHWEST);
        $specification->setOpacity(90);
        $specification->setScale(0);

        $watermarkRequest = new ImageWatermarkRequest();
        $watermarkRequest->setSource($source);
        $watermarkRequest->setSpecification($specification);

        $watermarkManifest =  self::$imageManager->createWatermarkManifest($watermarkRequest);
        $this->assertEquals("0f5781ad96c8413880c7b867bcccbba6", $watermarkManifest->getId());
    }

}