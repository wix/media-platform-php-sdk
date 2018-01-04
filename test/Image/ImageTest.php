<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/05/2017
 * Time: 11:11
 */

namespace Wix\Mediaplatform\Image;

use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Model\Request\CreateFileRequest;

class ImageTest extends BaseTest
{

    public function testFit()
    {
        $image = new Image("//test.com/file.png/v1/fit/w_709,h_400/file.png");
        $url = $image->fit(100, 200)
            ->toUrl();

        $this->assertEquals("//test.com/file.png/v1/fit/w_100,h_200/file.png", $url);
    }


    public function testFill()
    {
        $image = new Image("//test.com/file.png/v1/fill/w_709,h_400/file.png");
        $url = $image->fill(100, 200)
            ->toUrl();

        $this->assertEquals("//test.com/file.png/v1/fill/w_100,h_200/file.png", $url);
    }


    public function testCrop()
    {
        $image = new Image("//test.com/file.png/v1/crop/w_709,h_400,x_1,y_2,scl_1,q_75,usm_0.5_0.2_0.0/file.png");
        $url = $image->crop(100, 200, 1, 2, 3)
            ->brightness(10)
            ->jpeg(10)
            ->contrast(10)
            ->saturation(10)
            ->hue(10)
            ->blur(10)
            ->unsharpMask(10, 10, 10)
            ->toUrl();

        $this->assertEquals("//test.com/file.png/v1/crop/w_100,h_200,x_1,y_2,scl_3,blur_10,br_10,con_10,hue_10,q_10,sat_10,usm_10.00_10.00_10.00/file.png", $url);
    }


    public function testCropWithMetadata()
    {
        $image = new Image("//test.com/images/file.png/v1/crop/w_709,h_400,x_1,y_2,scl_1,q_75,usm_0.5_0.2_0.0/file.png#w_1000,h_2000,mt_image%2Fpng");
        $url = $image->crop(100, 200, 1, 2, 3)
            ->brightness(10)
            ->jpeg(10)
            ->contrast(10)
            ->saturation(10)
            ->hue(10)
            ->blur(10)
            ->unsharpMask(10, 10, 10)
            ->toUrl();

        $this->assertEquals("//test.com/images/file.png/v1/crop/w_100,h_200,x_1,y_2,scl_3,blur_10,br_10,con_10,hue_10,q_10,sat_10,usm_10.00_10.00_10.00/file.png#w_1000,h_2000,mt_image/png", $url);
    }


    public function testSmartCrop()
    {
        $image = new Image("//test.com/file.jpeg/v1/crop/w_709,h_400,x_1,y_2,scl_1,q_75,usm_0.5_0.2_0.0/file.jpeg");
        $url = $image->smartCrop(100, 200)
            ->toUrl();

        $this->assertEquals("//test.com/file.jpeg/v1/scrop/w_100,h_200,q_75,usm_0.50_0.20_0.00/file.jpeg", $url);
    }


    public function testParseSmartCrop()
    {
        $image = new Image("//test.com/file.jpeg/v1/scrop/w_100,h_200,q_75,usm_0.50_0.20_0.00/file.jpeg");
        $url = $image->toUrl();

        $this->assertEquals("//test.com/file.jpeg/v1/scrop/w_100,h_200,q_75,usm_0.50_0.20_0.00/file.jpeg", $url);
    }


    public function testAcceptsHTTP()
    {
        $image = new Image("http://test.com/1111/images/324234/v1/crop/w_709,h_400,x_1,y_2,scl_1/file.png#w_1000,h_2000,mt_image%2Fpng");
        $url = $image->toUrl();

        $this->assertEquals("http://test.com/1111/images/324234/v1/crop/w_709,h_400,x_1,y_2,scl_1/file.png#w_1000,h_2000,mt_image/png", $url);
    }


    public function testAcceptsHTTPS()
    {
        $image = new Image("https://test.com/dog.jpeg/v1/crop/w_709,h_400,x_1,y_2,scl_1/dog.jpeg#w_1000,h_2000,mt_image%2Fjpeg");
        $url = $image->toUrl();

        $this->assertEquals("https://test.com/dog.jpeg/v1/crop/w_709,h_400,x_1,y_2,scl_1/dog.jpeg#w_1000,h_2000,mt_image/jpeg", $url);
    }


    public function testAcceptsDoubleSlash()
    {
        $image = new Image("//images-wixmp-8cbe8e680e95a22c77c8d3d0.wixmp.com/media_manager_demo/common/SanFranHouse.jpg/v1/crop/w_475,h_267,x_1,y_2,scl_1.0/SanFranHouse.jpg");
        $url = $image->toUrl();

        $this->assertEquals("//images-wixmp-8cbe8e680e95a22c77c8d3d0.wixmp.com/media_manager_demo/common/SanFranHouse.jpg/v1/crop/w_475,h_267,x_1,y_2,scl_1/SanFranHouse.jpg", $url);
    }

    public function testWatermark()
    {
        $image = new Image("//test.com/images/file.png/v1/scrop/w_100,h_200,q_75,usm_0.50_0.20_0.00/file.png");
        $url = $image->watermark("abcdefghijklmnopqrstuvwxyz1234567890")->toUrl();

        $this->assertEquals("//test.com/images/file.png/v1/scrop/w_100,h_200,q_75,usm_0.50_0.20_0.00,wm_abcdefghijklmnopqrstuvwxyz1234567890/file.png", $url);

    }
}