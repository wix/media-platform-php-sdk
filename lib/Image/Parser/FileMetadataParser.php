<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 18:34
 */

namespace Wix\Mediaplatform\Image\Parser;

use Wix\Mediaplatform\Image\Image;
use Wix\Mediaplatform\Image\Metadata;
use Wix\Mediaplatform\Model\Metadata\Basic\ImageBasicMetadata;
use Wix\Mediaplatform\Model\Metadata\FileMetadata;

/**
 * Class FileMetadataParser
 * @package Wix\Mediaplatform\Image\Parser
 */
class FileMetadataParser
{
    /**
     * @param Image $image
     * @param FileMetadata $fileMetadata
     */
    public static function parse(Image $image, FileMetadata $fileMetadata)
    {
        FileDescriptorParser::parse($image, $fileMetadata->getFileDescriptor());

        if ($fileMetadata->getBasic() != null)
        {
            /**
             * we expect to get ImageBasicMetadata type here
             * @var ImageBasicMetadata $basicMetadata
             */
            $basicMetadata = $fileMetadata->getBasic();
            $metadata = new Metadata(
                $basicMetadata->getWidth(),
                $basicMetadata->getHeight(),
                $fileMetadata->getFileDescriptor()->getMimeType()
            );
            $image->setMetadata($metadata);
        }
    }
}