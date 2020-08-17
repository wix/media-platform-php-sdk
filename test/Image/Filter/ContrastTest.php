<?php


namespace Wix\Mediaplatform\Image\Encoder;

use \InvalidArgumentException;
use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Image\Filter\Contrast;

class ContrastTest extends BaseTest
{

    public function testOutOfUpperBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new Contrast(101);
    }

    public function testOutOfLowerBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new Contrast(-101);
    }


    public function testAtUpperBound()
    {
        new Contrast(-100);
        $this->addToAssertionCount(1);
    }

    public function testAtLowerBound()
    {
        new Contrast(100);
        $this->addToAssertionCount(1);
    }
}