<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:52
 */

namespace Wix\Mediaplatform\Model\Metadata;

use Wix\Mediaplatform\Model\Metadata\Basic\BasicMetadata;
use Wix\Mediaplatform\Model\Metadata\Basic\ImageBasicMetadata;
use Wix\Mediaplatform\Model\Metadata\Basic\VideoBasicMetadata;
use Wix\Mediaplatform\Model\Metadata\Features\Features;
use Wix\Mediaplatform\Model\Metadata\Features\ImageFeatures;
use Wix\Mediaplatform\Model\BaseModel;

/**
 * Class FileMetadata
 * @package Wix\Mediaplatform\Model\Metadata
 */
class FileMetadata extends BaseModel
{

    /**
     * @var FileDescriptor
     */
    protected $fileDescriptor;

    /**
     * @var BasicMetadata
     */
    protected $basic;

    /**
     * @var Features
     */
    protected $features;

    /**
     * FileMetadata constructor.
     * @param null $fileDescriptor
     * @param null $basic
     * @param null $features
     */
    public function __construct(Array $payload)
    {
        parent::__construct($payload);
        $this->fileDescriptor = new FileDescriptor($payload['fileDescriptor']);

        if($payload['mediaType'] == VideoBasicMetadata::MEDIA_TYPE) {
            $this->basic = new VideoBasicMetadata($payload['basic']);
        } elseif($payload['mediaType'] == ImageBasicMetadata::MEDIA_TYPE) {
            $this->basic = new ImageBasicMetadata($payload['basic']);
            $this->features = new ImageFeatures($payload['features']);
        }

    }

    /**
     * @return FileDescriptor
     */
    public function getFileDescriptor()
    {
        return $this->fileDescriptor;
    }

    /**
     * @return BasicMetadata
     */
    public function getBasic()
    {
        return $this->basic;
    }

    /**
     * @return Features
     */
    public function getFeatures()
    {
        return $this->features;
    }


    /**
     * @return string
     */
    public function toString()
    {
        return "FileMetadata{" .
            "fileDescriptor=" . $this->fileDescriptor .
            ", basic=" . $this->basic .
            ", features=" . $this->features .
            '}';
    }
}