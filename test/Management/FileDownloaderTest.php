<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/05/2017
 * Time: 10:58
 */

namespace Wix\Mediaplatform\Management;

use PHPUnit\Framework\TestCase;
use Wix\Mediaplatform\Authentication\Authenticator;
use Wix\Mediaplatform\Configuration\Configuration;
use Wix\Mediaplatform\Model\Request\Attachment;
use Wix\Mediaplatform\Model\Request\DownloadUrlRequest;
use Wix\Mediaplatform\Model\Request\SignedDownloadUrlRequest;

class FileDownloaderTest extends TestCase
{
    /**
     * @var Configuration
     */
    private static $configuration;
    /**
     * @var Authenticator
     */
    private static $authenticator;

    /**
     * @var FileDownloader
     */
    private static $fileDownloader;

    /**
     * Setup before running any test case
     */
    public static function setUpBeforeClass()
    {
        self::$configuration = new Configuration("wixmp-domain.appspot.com", "appId", "sharedSecret");
        self::$authenticator = new Authenticator(self::$configuration);
        self::$fileDownloader = new FileDownloader(self::$configuration, self::$authenticator);
    }

    public function testGetDownloadUrlDefault(){
        $url = self::$fileDownloader->getDownloadUrl("/file.txt");


        $this->assertStringStartsWith("https://wixmp-domain.appspot.com/_api/download/file?downloadToken=", $url);
    }

    public function testGetDownloadUrlWithOptions() {
        $downloadUrlRequest = new DownloadUrlRequest();
        $attachment = new Attachment();
        $attachment->setFilename("fish");
        $downloadUrlRequest->setOnExpireRedirectTo("url")
            ->setAttachment($attachment);

        $url = self::$fileDownloader->getDownloadUrl("/file.txt", $downloadUrlRequest);

        $this->assertStringStartsWith("https://wixmp-domain.appspot.com/_api/download/file?downloadToken=", $url);
    }

    public function testGetSignedUrlDefault() {
    	$url = self::$fileDownloader->getSignedUrl("/file.txt");
    	$this->assertStringStartsWith("https://wixmp-domain.wixmp.com/file.txt?token=", $url);
    }

	public function testGetSignedUrlWithOptions() {
		$signedDownloadUrlRequest = new SignedDownloadUrlRequest();
		$attachment = new Attachment();
		$attachment->setFilename("fish");
		$signedDownloadUrlRequest->setOnExpireRedirectTo("url")
		                   ->setAttachment($attachment);

		$url = self::$fileDownloader->getSignedUrl("/file.txt", $signedDownloadUrlRequest);

		$this->assertStringStartsWith("https://wixmp-domain.wixmp.com/file.txt?token=", $url);
	}
}
