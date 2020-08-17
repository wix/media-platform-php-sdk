<?php


namespace Wix\Mediaplatform\Image\Encoder;

use \InvalidArgumentException;
use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Image\Filter\UnsharpMask;

class UnsharpMaskTest extends BaseTest
{

    public function testRadiusOutOfUpperBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new UnsharpMask(501, 5, 100);
    }

    public function testRadiusOutOfLowerBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new UnsharpMask(0, 5, 100);
    }


    public function testRadiusAtLowerBound()
    {
        new UnsharpMask(0.1, 5, 100);
        $this->addToAssertionCount(1);
    }

    public function testRadiusAtUpperBound()
    {
        new UnsharpMask(500, 5, 100);
        $this->addToAssertionCount(1);
    }

    public function testAmountOutOfUpperBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new UnsharpMask(100, 11, 100);
    }

    public function testAmountOutOfLowerBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new UnsharpMask(100, -1, 100);
    }


    public function testAmountAtLowerBound()
    {
        new UnsharpMask(100, 0, 100);
        $this->addToAssertionCount(1);
    }

    public function testAmountAtUpperBound()
    {
        new UnsharpMask(100, 10, 100);
        $this->addToAssertionCount(1);
    }

    public function testThresholdOutOfUpperBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new UnsharpMask(100, 5, 256);
    }

    public function testThresholdOutOfLowerBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new UnsharpMask(100, 5, -1);
    }


    public function testThresholdAtLowerBound()
    {
        new UnsharpMask(100, 5, 0);
        $this->addToAssertionCount(1);
    }

    public function testThresholdAtUpperBound()
    {
        new UnsharpMask(100, 5, 255);
        $this->addToAssertionCount(1);
    }

}