<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 14:34
 */

namespace Wix\Mediaplatform\Image;


use Wix\Mediaplatform\Image\Encoder\JPEG;
use Wix\Mediaplatform\Image\Filter\Blur;
use Wix\Mediaplatform\Image\Filter\Brightness;
use Wix\Mediaplatform\Image\Filter\Contrast;
use Wix\Mediaplatform\Image\Filter\Hue;
use Wix\Mediaplatform\Image\Filter\Saturation;
use Wix\Mediaplatform\Image\Filter\UnsharpMask;
use Wix\Mediaplatform\Image\Framing\Crop;
use Wix\Mediaplatform\Image\Framing\Frame;
use Wix\Mediaplatform\Image\Framing\SmartCrop;
use Wix\Mediaplatform\Image\Parser\FileDescriptorParser;
use Wix\Mediaplatform\Image\Parser\FileMetadataParser;
use Wix\Mediaplatform\Image\Parser\ImageUrlParser;
use Wix\Mediaplatform\Model\Metadata\FileDescriptor;
use Wix\Mediaplatform\Model\Metadata\FileMetadata;

/**
 * Class Image
 * @package Wix\Mediaplatform\Image
 */
class Image
{
    /**
     * @var string
     */
    const API_VERSION = "v1";

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var Metadata
     */
    private $metadata;

    /**
     * @var Frame
     */
    private $frame;

    /**
     * @var array[Option]
     */
    private $options = array();

    /**
     * Image constructor.
     * @param $param string|FileDescriptor|FileMetadata
     */
    public function __construct($param)
    {
        if (is_string($param)) {
            ImageUrlParser::parse($this, $param);
        } else if (is_a($param, 'Wix\Mediaplatform\Model\Metadata\FileDescriptor')) {
            FileDescriptorParser::parse($this, $param);
        } else if (is_a($param, 'Wix\Mediaplatform\Model\Metadata\FileMetadata')) {
            FileMetadataParser::parse($this, $param);
        }
    }

    /**
     * @param string $host
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param string $fileName
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @param Metadata $metadata
     * @return $this
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
        return $this;
    }


    /**
     * @param int $width
     * @param int $height
     * @param int $x
     * @param int $y
     * @param float $scaleFactor
     * @return $this
     */
    public function crop($width, $height, $x, $y, $scaleFactor)
    {
        $this->frame = new Crop($x, $y, $width, $height, $scaleFactor);
        return $this;
    }

    /**
     * @param int $width
     * @param int $height
     * @return $this
     */
    public function smartCrop($width, $height)
    {
        $this->frame = new SmartCrop($width, $height);
        return $this;
    }

    /**
     * @param Option $option
     * @return $this
     */
    public function addOption(Option $option)
    {
        if(!empty($this->options[$option->getKey()])) {
            unset($this->options[$option->getKey()]);
        }

        $this->options[$option->getKey()] = $option;
        return $this;
    }

    /**
     * @param int $percentage
     * @return Image
     */
    public function blur($percentage)
    {
        return $this->addOption(new Blur($percentage));
    }

    /**
     * @param int $brightness
     * @return Image
     */
    public function brightness($brightness)
    {
        return $this->addOption(new Brightness($brightness));
    }

    /**
     * @param int $contrast
     * @return Image
     */
    public function contrast($contrast)
    {
        return $this->addOption(new Contrast($contrast));
    }

    /**
     * @param int $hue
     * @return Image
     */
    public function hue($hue)
    {
        return $this->addOption(new Hue($hue));
    }

    /**
     * @param int $saturation
     * @return Image
     */
    public function saturation($saturation) {
        return $this->addOption(new Saturation($saturation));
    }

    /**
     * @param float $radius
     * @param float $amount
     * @param float $threshold
     * @return Image
     */
    public function unsharpMask($radius, $amount, $threshold)
    {
        return $this->addOption(new UnsharpMask($radius, $amount, $threshold));
    }

    /**
     * @param int $quality
     * @return Image
     */
    public function jpeg($quality)
    {
        return $this->addOption(new JPEG($quality));
    }

    /**
     * @return string
     */
    public function toUrl()
    {
        $url = "";

        if (!empty($this->host != null)) {
            if (substr($this->host, 0, strlen("http")) !== "http" &&
                substr($this->host, 0, strlen("//")) !== "//"
            ) {
                $url .= "//";
            }

            $url .= rtrim($this->host, StringToken::FORWARD_SLASH);
        }

        $url .= $this->path .
            StringToken::FORWARD_SLASH .
            self::API_VERSION .
            StringToken::FORWARD_SLASH;

        $url .= $this->frame->serialize();

        $i = count($this->options);

        foreach ($this->options as $key => $option) {
            if ($i > 0) {
                $url .= StringToken::COMMA;
            }

            $url .= $option->serialize();
            $i--;
        }

        $url .= StringToken::FORWARD_SLASH . $this->fileName;

        if ($this->metadata != null) {
            $url .= StringToken::HASH . $this->metadata->serialize();
        }

        return $url;
    }
}