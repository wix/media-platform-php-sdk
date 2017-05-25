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
 * Class Blur
 * @package Wix\Mediaplatform\Image\Blur
 */
class Blur extends Option
{
    /**
     *
     */
    const KEY = "blur";

    /**
     * @var int
     */
    private $percentage;

    /**
     * Blur constructor.
     * @param int $percentage
     */
    public function __construct($percentage = null)
    {
        parent::__construct(self::KEY);
        if ($percentage) {
            if (!Validation::inRange($percentage, 0, 100)) {
                throw new InvalidArgumentException($percentage . " is not in range [0,100]");
            }

            $this->percentage = $percentage;
        }
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return self::KEY . StringToken::UNDERSCORE . $this->percentage;
    }

    /**
     * @param $params
     * @return $this
     */
    public function deserialize($params)
    {
        $this->percentage = (int)$params[0];
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Blur{" .
            "percentage=" . $this->percentage .
            '}';
    }
}