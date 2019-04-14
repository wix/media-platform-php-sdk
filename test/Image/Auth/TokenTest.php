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
        $jwt = Token::createWatermarkToken("appId", "appSecret", "/path/file.jpg",
            '/watermarks/path/file.png', 300, 300, 40, 5, 1 );

        $decoded = (array) JWT::decode($jwt, "appSecret", array("HS256"));

        $this->assertEquals('urn:app:appId', $decoded['sub']);
        $this->assertEquals('urn:app:appId', $decoded['iss']);
        $this->assertEquals(array('urn:service:image.watermark'), $decoded['aud']);
        $this->assertEquals('/path/file.jpg', $decoded['obj'][0][0]->path);
        $this->assertEquals('/watermarks/path/file.png', $decoded['obj'][0][0]->watermark);
        $this->assertEquals('<=300', $decoded['obj'][0][0]->height);
        $this->assertEquals('<=300', $decoded['obj'][0][0]->width);

        $this->assertEquals($jwt, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOmFwcElkIiwiaXNzIjoidXJuOmFwcDphcHBJZCIsIm9iaiI6W1t7InBhdGgiOiJcL3BhdGhcL2ZpbGUuanBnIiwid2F0ZXJtYXJrIjoiXC93YXRlcm1hcmtzXC9wYXRoXC9maWxlLnBuZyIsImhlaWdodCI6Ijw9MzAwIiwid2lkdGgiOiI8PTMwMCIsIm9wYWNpdHkiOjQwLCJwb3NpdGlvbiI6NSwic2NhbGUiOjF9XV0sImF1ZCI6WyJ1cm46c2VydmljZTppbWFnZS53YXRlcm1hcmsiXX0.CkDxUNOTrRK3JQfSRIhISOSEXCmq14SwKRRVchJ2HgQ');
    }
}
