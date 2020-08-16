<?php


namespace Wix\Mediaplatform\Image\Framing;


use Wix\Mediaplatform\Image\StringToken;

class Fit implements Frame
{
    const NAME = "fit";

    /**
     * @var int
     */
    protected $width;

    /**
     * @var int 
     */
    protected $height;

    /**
     * Fill constructor.
     * @param int $width
     * @param int $height
     */
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function serialize() {
        return self::NAME . 
            StringToken::FORWARD_SLASH . 
            StringToken::KEY_WIDTH . 
            StringToken::UNDERSCORE . 
            $this->width . 
            StringToken::COMMA .
            StringToken::KEY_HEIGHT . 
            StringToken::UNDERSCORE . 
            $this->height;
    }
}