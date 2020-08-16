<?php


namespace Wix\Mediaplatform\Image\Filter;

use InvalidArgumentException;
use Wix\Mediaplatform\Image\Option;
use Wix\Mediaplatform\Image\StringToken;
use Wix\Mediaplatform\Image\Validation;

/**
 * Class Saturation
 * @package Wix\Mediaplatform\Image\Saturation
 */
class Saturation extends Option
{
    /**
     *
     */
    const KEY = "sat";

    /**
     * @var int
     */
    protected $saturation;

    /**
     * Saturation constructor.
     * @param int $saturation
     */
    public function __construct($saturation = null)
    {
        parent::__construct(self::KEY);
        if ($saturation) {
            if (!Validation::inRange($saturation, -100, 100)) {
                throw new InvalidArgumentException($saturation . " is not in range [-100,100]");
            }

            $this->saturation = $saturation;
        }
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return self::KEY . StringToken::UNDERSCORE . $this->saturation;
    }

    /**
     * @param $params
     * @return $this
     */
    public function deserialize(array $params)
    {
        $this->saturation = (int)$params[0];
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Saturation{" .
            "saturation=" . $this->saturation .
            '}';
    }
}