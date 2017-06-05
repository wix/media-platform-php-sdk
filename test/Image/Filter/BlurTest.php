<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 29/05/2017
 * Time: 11:11
 */

namespace Wix\Mediaplatform\Image\Encoder;

use \InvalidArgumentException;
use Wix\Mediaplatform\BaseTest;
use Wix\Mediaplatform\Image\Filter\Blur;

class BlurTest extends BaseTest
{

    public function testOutOfUpperBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new Blur(101);
    }

    public function testOutOfLowerBound()
    {
        $this->expectException(InvalidArgumentException::class);
        new Blur(-1);
    }


    public function testAtUpperBound()
    {
        new Blur(0);
        $this->addToAssertionCount(1);
    }

    public function testAtLowerBound()
    {
        new Blur(100);
        $this->addToAssertionCount(1);
    }
}