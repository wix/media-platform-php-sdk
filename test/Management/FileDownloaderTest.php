<?php


namespace Wix\Mediaplatform\Management;

use Firebase\JWT\JWT;
use PHPUnit\Framework\TestCase;
use Wix\Mediaplatform\Authentication\Authenticator;
use Wix\Mediaplatform\Configuration\Configuration;
use Wix\Mediaplatform\Model\Request\Attachment;
use Wix\Mediaplatform\Model\Request\DownloadUrlRequest;
use Wix\Mediaplatform\Model\Request\SignedDownloadUrlRequest;
use function GuzzleHttp\Psr7\parse_query;

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

    public function testGetSignedUrlDefault() {
    	$url = self::$fileDownloader->getSignedUrl("/file.txt");
	    $urlParts = parse_url($url);
	    $this->assertEquals("https", $urlParts["scheme"]);
	    $this->assertEquals("wixmp-domain.wixmp.com", $urlParts["host"]);
	    $this->assertEquals("/file.txt", $urlParts["path"]);

	    $queryParams = parse_query($urlParts["query"]);
	    $this->assertNotEmpty($queryParams["token"]);

	    $decoded = (array) JWT::decode($queryParams["token"], "sharedSecret", array("HS256"));
	    $this->assertEquals("/file.txt", $decoded["obj"][0][0]->path);
	    $this->assertEquals("urn:service:file.download", $decoded["aud"][0]);
    }

	public function testGetSignedUrlWithOptions() {
		$signedDownloadUrlRequest = new SignedDownloadUrlRequest();
		$attachment = new Attachment();
		$attachment->setFilename("fish");
		$signedDownloadUrlRequest->setOnExpireRedirectTo("url")
		                   ->setAttachment($attachment);

		$url = self::$fileDownloader->getSignedUrl("/file.txt", $signedDownloadUrlRequest);

		$urlParts = parse_url($url);
		$this->assertEquals("https", $urlParts["scheme"]);
		$this->assertEquals("wixmp-domain.wixmp.com", $urlParts["host"]);
		$this->assertEquals("/file.txt", $urlParts["path"]);

		$queryParams = parse_query($urlParts["query"]);

		$this->assertNotEmpty($queryParams["token"]);

		$decoded = (array) JWT::decode($queryParams["token"], "sharedSecret", array("HS256"));
		$this->assertEquals("/file.txt", $decoded["obj"][0][0]->path);
		$this->assertEquals("urn:service:file.download", $decoded["aud"][0]);
		$this->assertEquals("url", $decoded["red"]);

		$this->assertEquals("fish", $queryParams["filename"]);
	}
}
