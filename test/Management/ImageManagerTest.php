<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/05/2017
 * Time: 11:11
 */

namespace Wix\Mediaplatform\Management;

use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Model\Request\ExtractImageFeaturesRequest;

class ImageManagerText extends BaseTest
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

}