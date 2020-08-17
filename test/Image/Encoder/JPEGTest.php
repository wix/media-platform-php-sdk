<?php


namespace Wix\Mediaplatform\Image\Encoder;

use \InvalidArgumentException;
use Wix\Mediaplatform\BaseTest;

class JPEGTest extends BaseTest
{

    public function testOutOfUpperBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new JPEG(101);
    }

    public function testOutOfLowerBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new JPEG(-1);
    }


    public function testAtUpperBound()
    {
        new JPEG(0);
        $this->addToAssertionCount(1);
    }

    public function testAtLowerBound()
    {
        new JPEG(100);
        $this->addToAssertionCount(1);
    }
}