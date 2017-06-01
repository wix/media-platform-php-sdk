<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 15:14
 */

namespace Wix\Mediaplatform\Image\Encoder;


use InvalidArgumentException;
use Wix\Mediaplatform\Image\Option;
use Wix\Mediaplatform\Image\StringToken;
use Wix\Mediaplatform\Image\Validation;

/**
 * Class JPEG
 * @package Wix\Mediaplatform\Image\Encoder
 */
class JPEG extends Option
{
    /**
     * @var string
     */
    const KEY = "q";

    /**
     * @var int
     */
    private $quality;

    /**
     * JPEG constructor.
     * @param int $quality
     */
    public function __construct($quality = null)
    {
        parent::__construct(self::KEY);
        if ($quality) {
            if (!Validation::inRange($quality, 0, 100)) {
                throw new InvalidArgumentException($quality . " is not in range [0,100]");
            }

            $this->quality = $quality;
        }
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return self::KEY . StringToken::UNDERSCORE . $this->quality;
    }

    /**
     * @param $params
     * @return $this
     */
    public function deserialize(array $params)
    {
        $this->quality = (int)$params[0];
        return $this;
    }
}