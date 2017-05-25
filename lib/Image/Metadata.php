<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 15:03
 */

namespace Wix\Mediaplatform\Image;


/**
 * Class Metadata
 * @package Wix\Mediaplatform\Image
 */
class Metadata
{
    /**
     * @var string
     */
    const KEY_MIME_TYPE = "mt";

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var string
     */
    private $mimeType;

    /**
     * Metadata constructor.
     * @param $width
     * @param $height
     * @param $mimeType
     */
    public function __construct($width, $height, $mimeType)
    {
        $this->width = $width;
        $this->height = $height;
        $this->mimeType = $mimeType;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }


    /**
     * @return string the URL fragment (after the #) string representation
     */
    public function serialize()
    {
        return StringToken::KEY_WIDTH . "_" .
            $this->width . "," .
            StringToken::KEY_HEIGHT . "_" .
            $this->height . "," .
            StringToken::KEY_MIME_TYPE . "_" .
            urlencode($this->mimeType);
    }
}