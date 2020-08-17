<?php


namespace Wix\Mediaplatform\Image\Encoder;

use \InvalidArgumentException;
use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Image\Filter\Saturation;

class SaturationTest extends BaseTest
{

    public function testOutOfUpperBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new Saturation(101);
    }

    public function testOutOfLowerBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new Saturation(-101);
    }


    public function testAtUpperBound()
    {
        new Saturation(-100);
        $this->addToAssertionCount(1);
    }

    public function testAtLowerBound()
    {
        new Saturation(100);
        $this->addToAssertionCount(1);
    }
}