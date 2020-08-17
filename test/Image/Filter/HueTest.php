<?php


namespace Wix\Mediaplatform\Image\Encoder;

use \InvalidArgumentException;
use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Image\Filter\Hue;

class HueTest extends BaseTest
{

    public function testOutOfUpperBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new Hue(101);
    }

    public function testOutOfLowerBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new Hue(-101);
    }


    public function testAtUpperBound()
    {
        new Hue(-100);
        $this->addToAssertionCount(1);
    }

    public function testAtLowerBound()
    {
        new Hue(100);
        $this->addToAssertionCount(1);
    }
}