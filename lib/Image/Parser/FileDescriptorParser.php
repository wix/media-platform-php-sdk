<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 18:28
 */

namespace Wix\Mediaplatform\Image\Parser;

use Wix\Mediaplatform\Image\Image;
use Wix\Mediaplatform\Model\Metadata\FileDescriptor;

/**
 * Class FileDescriptorParser
 * @package Wix\Mediaplatform\Image\Parser
 */
class FileDescriptorParser
{
    /**
     * @param Image $image
     * @param FileDescriptor $fileDescriptor
     */
    public static function parse(Image $image, FileDescriptor $fileDescriptor)
    {
        list($type, $format) = explode("/", $fileDescriptor->getMimeType());
        if (strtolower($type) != "image") {
            throw new \InvalidArgumentException("not an image file descriptor");
        }

        $image->setPath($fileDescriptor->getPath());
        $image->setFileName(basename($fileDescriptor->getPath()));
    }
}