<?php

namespace Wix\Mediaplatform\Image\Parser;


use InvalidArgumentException;
use Wix\Mediaplatform\Image\Auth\Token;
use Wix\Mediaplatform\Image\Encoder\JPEG;
use Wix\Mediaplatform\Image\Filter\Blur;
use Wix\Mediaplatform\Image\Filter\Brightness;
use Wix\Mediaplatform\Image\Filter\Contrast;
use Wix\Mediaplatform\Image\Filter\Hue;
use Wix\Mediaplatform\Image\Filter\Saturation;
use Wix\Mediaplatform\Image\Filter\UnsharpMask;
use Wix\Mediaplatform\Image\Filter\Watermark;
use Wix\Mediaplatform\Image\Framing\Crop;
use Wix\Mediaplatform\Image\Image;
use Wix\Mediaplatform\Image\Metadata;
use Wix\Mediaplatform\Image\Option;
use Wix\Mediaplatform\Image\StringToken;

class ImageUrlParser
{

    /**
     * @var array
     */
    const OPTIONS = array(
	    Token::KEY       => 'Wix\Mediaplatform\Image\Auth\Token',
	    Blur::KEY        => 'Wix\Mediaplatform\Image\Filter\Blur',
	    Brightness::KEY  => 'Wix\Mediaplatform\Image\Filter\Brightness',
	    Contrast::KEY    => 'Wix\Mediaplatform\Image\Filter\Contrast',
	    JPEG::KEY        => 'Wix\Mediaplatform\Image\Encoder\JPEG',
	    Hue::KEY         => 'Wix\Mediaplatform\Image\Filter\Hue',
	    Saturation::KEY  => 'Wix\Mediaplatform\Image\Filter\Saturation',
	    UnsharpMask::KEY => 'Wix\Mediaplatform\Image\Filter\UnsharpMask',
	    Watermark::KEY   => 'Wix\Mediaplatform\Image\Filter\Watermark',
    );

    /**
     * @param Image $image
     * @param $url
     */
    public static function parse(Image $image, $url)
    {
        $explodedUrl = new ExplodedUrl($url);

        $image->setFileName($explodedUrl->getFileName());
        $image->setPath($explodedUrl->getPath());
        $image->setHost($explodedUrl->getHost());
        $image->setMetadata(self::parseFragment($explodedUrl->getFragment()));

        self::applyOptions($image, $explodedUrl->getGeometry(), $explodedUrl->getOptions());
    }

    /**
     * @param $fragment
     * @return null|Metadata
     */
    private static function parseFragment($fragment)
    {
        if ($fragment == null) {
            return null;
        }

        $values = array();
        $parts = explode(StringToken::COMMA, $fragment);
        foreach ($parts as $part) {
            $params = explode(StringToken::UNDERSCORE, $part);
            if (count($params) < 2) {
                continue;
            }

            $values[$params[0]] = $params[1];
        }

        if (empty($values[StringToken::KEY_WIDTH]) ||
            empty($values[StringToken::KEY_HEIGHT]) ||
            empty($values[Metadata::KEY_MIME_TYPE])
        ) {
            return null;
        }

        return new Metadata((int)$values[StringToken::KEY_WIDTH], (int)$values[StringToken::KEY_HEIGHT], urldecode($values[Metadata::KEY_MIME_TYPE]));
    }

    private static function applyOptions(Image $image, $geometry, $options)
    {
        $params = array();
        $parts = explode(StringToken::COMMA, $options);

        foreach ($parts as $part) {
            $paramArr = explode(StringToken::UNDERSCORE, $part);
            $paramKey = array_shift($paramArr);
            $params[$paramKey] = $paramArr;
        }

        $method = self::findMethod($image, $geometry);
        if ($method == null) {
            throw new InvalidArgumentException("geometry not supported");
        }

        try {
            switch ($method) {
                case "crop":
                    $image->$method(
                        (int)$params[StringToken::KEY_WIDTH][0],
                        (int)$params[StringToken::KEY_HEIGHT][0],
                        (int)$params[Crop::KEY_X][0],
                        (int)$params[Crop::KEY_Y][0],
                        (int)$params[Crop::KEY_SCALE][0]
                    );

                    unset($params[StringToken::KEY_WIDTH]);
                    unset($params[StringToken::KEY_HEIGHT]);
                    unset($params[Crop::KEY_X]);
                    unset($params[Crop::KEY_Y]);
                    unset($params[Crop::KEY_SCALE]);
                    break;
                default:
                    $image->$method(
                        (int)$params[StringToken::KEY_WIDTH][0],
                        (int)$params[StringToken::KEY_HEIGHT][0]
                    );
                    unset($params[StringToken::KEY_WIDTH]);
                    unset($params[StringToken::KEY_HEIGHT]);
                    break;
            }
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException("geometry not supported");
        }

        foreach ($params as $paramKey => $paramValue) {
            try {
                $className = self::OPTIONS[$paramKey];
                /**
                 * abstract option
                 * @var Option $option
                 */
                $option = new $className;

                $option->deserialize($paramValue);
                $image->addOption($option);
            } catch (InvalidArgumentException $e) {
                throw new InvalidArgumentException("option not supported");
            }
        }
    }

    /**
     * @param Image $image
     * @param $methodName
     * @return string|null
     */
    private static function findMethod(Image $image, $methodName)
    {
        if ($methodName === "scrop")
        {
            $methodName = "smartCrop";
        }

        $methods = get_class_methods(get_class($image));
        foreach ($methods as $method) {
            if ($method === $methodName) {
                return $method;
            }
        }

        return null;
    }
}