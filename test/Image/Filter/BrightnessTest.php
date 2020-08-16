<?php


namespace Wix\Mediaplatform\Image\Encoder;

use \InvalidArgumentException;
use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Image\Filter\Brightness;

class BrightnessTest extends BaseTest
{

    public function testOutOfUpperBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new Brightness(101);
    }

    public function testOutOfLowerBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new Brightness(-101);
    }


    public function testAtUpperBound()
    {
        new Brightness(-100);
        $this->addToAssertionCount(1);
    }

    public function testAtLowerBound()
    {
        new Brightness(100);
        $this->addToAssertionCount(1);
    }
}