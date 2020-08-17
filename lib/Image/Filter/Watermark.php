<?php


namespace Wix\Mediaplatform\Image\Filter;

use Wix\Mediaplatform\Image\Option;
use Wix\Mediaplatform\Image\StringToken;

/**
 * Class Watermark
 * @package Wix\Mediaplatform\Image\Filter\Watermark
 */
class Watermark extends Option
{
    /**
     *
     */
    const KEY = "wm";

    /**
     * @var int
     */
    protected $manifestId;

    /**
     * Blur constructor.
     * @param int $manifestId
     */
    public function __construct($manifestId = null)
    {
        parent::__construct(self::KEY);
        if ($manifestId) {
            $this->manifestId = $manifestId;
        }
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return self::KEY . StringToken::UNDERSCORE . $this->manifestId;
    }

    /**
     * @param $params
     * @return $this
     */
    public function deserialize(array $params)
    {
        $this->manifestId = (int)$params[0];
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Watermark{" .
            "manifestId=" . $this->manifestId .
            '}';
    }
}