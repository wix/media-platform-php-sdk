<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 15:24
 */

namespace Wix\Mediaplatform\Image\Brightness;

use InvalidArgumentException;
use Wix\Mediaplatform\Image\Option;
use Wix\Mediaplatform\Image\StringToken;
use Wix\Mediaplatform\Image\Validation;

/**
 * Class Brightness
 * @package Wix\Mediaplatform\Image\Brightness
 */
class Brightness extends Option
{
    /**
     *
     */
    const KEY = "br";

    /**
     * @var int
     */
    private $brightness;

    /**
     * Brightness constructor.
     * @param int $brightness
     */
    public function __construct($brightness = null)
    {
        parent::__construct(self::KEY);
        if ($brightness) {
            if (!Validation::inRange($brightness, -100, 100)) {
                throw new InvalidArgumentException($brightness . " is not in range [-100,100]");
            }

            $this->brightness = $brightness;
        }
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return self::KEY . StringToken::UNDERSCORE . $this->brightness;
    }

    /**
     * @param $params
     * @return $this
     */
    public function deserialize($params)
    {
        $this->brightness = (int)$params[0];
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Brightness{" .
            "brightness=" . $this->brightness .
            '}';
    }
}