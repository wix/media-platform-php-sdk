<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 15:24
 */

namespace Wix\Mediaplatform\Image\Filter;

use InvalidArgumentException;
use Wix\Mediaplatform\Image\Option;
use Wix\Mediaplatform\Image\StringToken;
use Wix\Mediaplatform\Image\Validation;

/**
 * Class UnsharpMask
 * @package Wix\Mediaplatform\Image\UnsharpMask
 */
class UnsharpMask extends Option
{
    /**
     *
     */
    const KEY = "usm";

    /**
     * @var float
     */
    private $radius;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var float
     */
    private $threshold;

    /**
     * UnsharpMask constructor.
     * @param int $unsharpMask
     */
    public function __construct($radius = null, $amount = null, $threshold = null)
    {
        parent::__construct(self::KEY);

        if (!is_null($radius)) {
            if (!Validation::inRange($radius, 0.1, 500)) {
                throw new InvalidArgumentException($radius . " is not in range [0.1,500]");
            }

            $this->radius = $radius;
        }

        if (!is_null($amount)) {
            if (!Validation::inRange($amount, 0, 10)) {
                throw new InvalidArgumentException($amount . " is not in range [0,10]");
            }

            $this->amount = $amount;
        }

        if (!is_null($threshold)) {
            if (!Validation::inRange($threshold, 0, 255)) {
                throw new InvalidArgumentException($threshold . " is not in range [0,255]");
            }

            $this->threshold = $threshold;
        }
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return self::KEY . StringToken::UNDERSCORE . $this->decimalString($this->radius) .
            StringToken::UNDERSCORE . $this->decimalString($this->amount) .
            StringToken::UNDERSCORE . $this->decimalString($this->threshold);
    }

    /**
     * @param array $params
     * @return $this
     */
    public function deserialize(array $params)
    {
        $this->radius = (float)$params[0];
        $this->amount = (float)$params[1];
        $this->threshold = (float)$params[2];
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "UnsharpMask{" .
            "unsharpMask=" . $this->unsharpMask .
            '}';
    }
}