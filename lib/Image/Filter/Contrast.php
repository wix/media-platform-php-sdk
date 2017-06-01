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
 * Class Contrast
 * @package Wix\Mediaplatform\Image\Contrast
 */
class Contrast extends Option
{
    /**
     *
     */
    const KEY = "con";

    /**
     * @var int
     */
    private $contrast;

    /**
     * Contrast constructor.
     * @param int $contrast
     */
    public function __construct($contrast = null)
    {
        parent::__construct(self::KEY);
        if ($contrast) {
            if (!Validation::inRange($contrast, -100, 100)) {
                throw new InvalidArgumentException($contrast . " is not in range [-100,100]");
            }

            $this->contrast = $contrast;
        }
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return self::KEY . StringToken::UNDERSCORE . $this->contrast;
    }

    /**
     * @param $params
     * @return $this
     */
    public function deserialize(array $params)
    {
        $this->contrast = (int)$params[0];
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Contrast{" .
            "contrast=" . $this->contrast .
            '}';
    }
}