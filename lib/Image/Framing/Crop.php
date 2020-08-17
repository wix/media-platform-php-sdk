<?php


namespace Wix\Mediaplatform\Image\Framing;


use Wix\Mediaplatform\Image\StringToken;

class Crop implements Frame
{
    const NAME = "crop";

    const KEY_X = "x";

    const KEY_Y = "y";

    const KEY_SCALE = "scl";

    /**
     * @var int
     */
    protected $x;

    /**
     * @var int
     */
    protected $y;

    /**
     * @var int
     */
    protected $width;

    /**
     * @var int 
     */
    protected $height;

    /**
     * @var float
     */
    protected $scale;

    /**
     * Crop constructor.
     * @param int $x
     * @param int $y
     * @param int $width
     * @param int $height
     * @param float $scale
     */
    public function __construct($x, $y, $width, $height, $scale)
    {
        $this->x = $x;
        $this->y = $y;
        $this->width = $width;
        $this->height = $height;
        $this->scale = $scale;
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
            $this->height .
            StringToken::COMMA .
            self::KEY_X . 
            StringToken::UNDERSCORE . 
            $this->x .
            StringToken::COMMA .
            self::KEY_Y .
            StringToken::UNDERSCORE .
            $this->y .
            StringToken::COMMA .
            self::KEY_SCALE .
            StringToken::UNDERSCORE .
            $this->scale;
    }
}