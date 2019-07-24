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
use Wix\Mediaplatform\Image\Gravity;
use Wix\Mediaplatform\Image\WatermarkProperties;

class TokenTest extends BaseTest
{

    public function testToken()
    {
        new Token();
	    $this->addToAssertionCount(1);

    }

    public function testGenerateImageToken() {
    	$jwt = Token::createImageToken("appId", "appSecret", "/file/path", 100, 200);

    	$decoded = (array) JWT::decode($jwt, "appSecret", array("HS256"));

    	$this->assertEquals('urn:app:appId', $decoded['sub']);
    	$this->assertEquals('urn:app:appId', $decoded['iss']);
    	$this->assertEquals(array('urn:service:image.operations'), $decoded['aud']);
    	$this->assertEquals('<=100', $decoded['obj'][0][0]->height);
    	$this->assertEquals('/file/path', $decoded['obj'][0][0]->path);
    	$this->assertEquals('<=200', $decoded['obj'][0][0]->width);

        $this->assertEquals($jwt, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOmFwcElkIiwiaXNzIjoidXJuOmFwcDphcHBJZCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9MTAwIiwicGF0aCI6IlwvZmlsZVwvcGF0aCIsIndpZHRoIjoiPD0yMDAifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.YIvfZkNo5RoCKiYJeR-IMjDA3vEQ1ySug24lc47RSDU');
    }

    public function testGenerateOriginalImageToken() {
        $jwt = Token::createOriginalImageToken("appId", "appSecret", "/file/path");

        $decoded = (array) JWT::decode($jwt, "appSecret", array("HS256"));

        $this->assertEquals('urn:app:appId', $decoded['sub']);
        $this->assertEquals('urn:app:appId', $decoded['iss']);
        $this->assertEquals(array('urn:service:file.download'), $decoded['aud']);
        $this->assertEquals('/file/path', $decoded['obj'][0][0]->path);

        $this->assertEquals($jwt, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOmFwcElkIiwiaXNzIjoidXJuOmFwcDphcHBJZCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZpbGVcL3BhdGgifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6ZmlsZS5kb3dubG9hZCJdfQ.jdcOta9QgXkDql-4JIt4DEV-x3HRVaIk4bKlzxjPHwA');
    }

    public function testGenerateWatermarkToken() {
    	$watermarkProperties = new WatermarkProperties('/watermarks/path/file.png', 40, 0.25, Gravity::NORTHEAST);

        $jwt = Token::createWatermarkToken("appId", "appSecret", "/path/file.jpg",
	         300, 300, $watermarkProperties );

        $decoded = (array) JWT::decode($jwt, "appSecret", array("HS256"));

        $this->assertEquals('urn:app:appId', $decoded['sub']);
        $this->assertEquals('urn:app:appId', $decoded['iss']);
        $this->assertEquals(array('urn:service:image.watermark'), $decoded['aud']);
        $this->assertEquals('/path/file.jpg', $decoded['obj'][0][0]->path);
        $this->assertEquals('/watermarks/path/file.png', $decoded['wmk']->path);
        $this->assertEquals('<=300', $decoded['obj'][0][0]->height);
        $this->assertEquals('<=300', $decoded['obj'][0][0]->width);

        $this->assertEquals($jwt, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOmFwcElkIiwiaXNzIjoidXJuOmFwcDphcHBJZCIsIm9iaiI6W1t7InBhdGgiOiJcL3BhdGhcL2ZpbGUuanBnIiwiaGVpZ2h0IjoiPD0zMDAiLCJ3aWR0aCI6Ijw9MzAwIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmltYWdlLndhdGVybWFyayJdLCJ3bWsiOnsicGF0aCI6Ilwvd2F0ZXJtYXJrc1wvcGF0aFwvZmlsZS5wbmciLCJvcGFjaXR5Ijo0MCwicHJvcG9ydGlvbnMiOjAuMjUsImdyYXZpdHkiOiJub3J0aC1lYXN0In19.vIrmJiLC8pSlCmUbM1zERATW5_zklXZffqpGPUE9sDI');
    }
}
