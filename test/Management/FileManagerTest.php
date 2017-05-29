<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/05/2017
 * Time: 11:11
 */

namespace Wix\Mediaplatform\Management;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use PHPUnit\Framework\TestCase;
use Wix\Mediaplatform\Authentication\Authenticator;
use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Configuration\Configuration;
use Wix\Mediaplatform\Http\AuthenticatedHTTPClient;
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

    public function testCreateFile(){
        parent::setUpMockResponse(array("Content-Type" => "application/json"), "file-descriptor-response.json");
        self::$fileUploader = new FileUploader(BaseTest::$configuration, BaseTest::$authenticatedHttpClient);
        self::$fileManager = new FileManager(BaseTest::$configuration, BaseTest::$authenticatedHttpClient, self::$fileUploader);

        $createFileRequest = new CreateFileRequest();
        $createFileRequest->setPath("/");
        $fileDescriptor = self::$fileManager->createFile($createFileRequest);
        $this->assertEquals("d0e18fd468cd4e53bc2bbec3ca4a8676", $fileDescriptor->getId());
    }
}
