<?php


namespace Wix\Mediaplatform\Image\Filter;

use InvalidArgumentException;
use Wix\Mediaplatform\Image\Option;
use Wix\Mediaplatform\Image\StringToken;
use Wix\Mediaplatform\Image\Validation;

/**
 * Class Hue
 * @package Wix\Mediaplatform\Image\Hue
 */
class Hue extends Option
{
    /**
     *
     */
    const KEY = "hue";

    /**
     * @var int
     */
    protected $hue;

    /**
     * Hue constructor.
     * @param int $hue
     */
    public function __construct($hue = null)
    {
        parent::__construct(self::KEY);
        if ($hue) {
            if (!Validation::inRange($hue, -100, 100)) {
                throw new InvalidArgumentException($hue . " is not in range [-100,100]");
            }

            $this->hue = $hue;
        }
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return self::KEY . StringToken::UNDERSCORE . $this->hue;
    }

    /**
     * @param $params
     * @return $this
     */
    public function deserialize(array $params)
    {
        $this->hue = (int)$params[0];
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Hue{" .
            "hue=" . $this->hue .
            '}';
    }
}