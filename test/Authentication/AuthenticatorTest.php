<?php
namespace Wix\Mediaplatform\Authentication;

use PHPUnit\Framework\TestCase;
use Wix\Mediaplatform\Configuration\Configuration;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/05/2017
 * Time: 10:14
 */
class AuthenticatorTest extends TestCase
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
     * Setup before running any test case
     */
    public static function setUpBeforeClass()
    {
        self::$configuration = new Configuration("domain", "appId", "sharedSecret");
        self::$authenticator = new Authenticator(self::$configuration);
    }


    /**
     * Test "Get Header"
     */
    public function testGetHeaderDefault()
    {
        $header = self::$authenticator->getHeader();

        $claims = self::$authenticator->decode($header)->toClaims();

        $this->assertEquals('urn:app:appId', $claims['iss']);
    }


    /**
     * Test "Get Custom Header"
     */
    public function testGetHeaderCustomToken()
    {
        $token = new Token();
        $token->setIssuer(NS::APPLICATION . self::$configuration->getAppId())
            ->setSubject(NS::APPLICATION . self::$configuration->getAppId())
            ->addVerb('verb');

        $header = self::$authenticator->getHeader($token);

        $claims = self::$authenticator->decode($header)->toClaims();

        $this->assertEquals('urn:app:appId', $claims['iss']);
        $this->assertEquals('verb', $claims['aud'][0]);
    }
}