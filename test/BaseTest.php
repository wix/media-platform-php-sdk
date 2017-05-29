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

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/05/2017
 * Time: 10:28
 */
class BaseTest extends TestCase
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
        $mock = new MockHandler(array(
            new Response(200, $headers, file_get_contents(self::MOCK_FILES_DIR . DIRECTORY_SEPARATOR . $mockResponseFile))
        ));

        $handler = HandlerStack::create($mock);
        $client = new Client(array('handler' => $handler));

        self::$authenticatedHttpClient = new AuthenticatedHTTPClient(self::$authenticator, $client);
    }
}