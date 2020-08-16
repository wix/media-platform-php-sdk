<?php
namespace Wix\Mediaplatform;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Wix\Mediaplatform\Authentication\Authenticator;
use Wix\Mediaplatform\Configuration\Configuration;
use Wix\Mediaplatform\Http\AuthenticatedHTTPClient;


abstract class BaseTest extends TestCase
{
    /**
     * @var Configuration
     */
    public static $configuration;

    /**
     * @var Authenticator
     */
    public static $authenticator;

    /**
     * @var AuthenticatedHTTPClient
     */
    public static $authenticatedHttpClient;

    const RESOURCES_DIR = __DIR__ . DIRECTORY_SEPARATOR . "resources";

    const MOCK_FILES_DIR = self::RESOURCES_DIR . DIRECTORY_SEPARATOR . '__files';

    const SOURCES_DIR = self::RESOURCES_DIR . DIRECTORY_SEPARATOR . '/source';

    public static function setUpBeforeClass()
    {
        self::$configuration = new Configuration("domain", "appId", "sharedSecret");
        self::$authenticator = new Authenticator(self::$configuration);
        $client = new Client();
        self::$authenticatedHttpClient = new AuthenticatedHTTPClient(self::$authenticator, $client);
    }

    public static function setUpMockResponse($headers, $mockResponseFile) {
        if(is_string($mockResponseFile)) {
            $mockResponseFile = array($mockResponseFile);
        }

        $responses = array();
        foreach($mockResponseFile as $mockResponseItem) {
            $responses[] = new Response(200, $headers, file_get_contents(self::MOCK_FILES_DIR . DIRECTORY_SEPARATOR . $mockResponseItem));
        }

        $mock = new MockHandler($responses);

        $handler = HandlerStack::create($mock);
        $client = new Client(array('handler' => $handler));

        self::$authenticatedHttpClient = new AuthenticatedHTTPClient(self::$authenticator, $client);
    }
}