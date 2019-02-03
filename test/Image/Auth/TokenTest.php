<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/05/2017
 * Time: 11:11
 */

namespace Wix\Mediaplatform\Image\Encoder;

use Firebase\JWT\JWT;
use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Image\Auth\Token;

class TokenTest extends BaseTest
{

    public function testToken()
    {
        new Token();
	    $this->addToAssertionCount(1);

    }

    public function testGenerateToken() {
    	$jwt = Token::createImageToken("appId", "appSecret", "/file/path", 100, 200);

    	$decoded = (array) JWT::decode($jwt, "appSecret", array("HS256"));

    	$this->assertEquals('urn:app:appId', $decoded['sub']);
    	$this->assertEquals('urn:app:appId', $decoded['iss']);
    	$this->assertEquals('urn:service:image.operations', $decoded['aud']);
    	$this->assertEquals('<=100', $decoded['obj'][0][0]->height);
    	$this->assertEquals('/file/path', $decoded['obj'][0][0]->path);
    	$this->assertEquals('<=200', $decoded['obj'][0][0]->width);
    }
}
