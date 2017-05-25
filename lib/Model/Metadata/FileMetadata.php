<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:52
 */

namespace Wix\Mediaplatform\Model\Metadata;

use Wix\Mediaplatform\Model\Metadata\Basic\BasicMetadata;
use Wix\Mediaplatform\Model\Metadata\Features\Features;

/**
 * Class FileMetadata
 * @package Wix\Mediaplatform\Model\Metadata
 */
class FileMetadata
{

    /**
     * @var FileDescriptor
     */
    private $fileDescriptor;

    /**
     * @var BasicMetadata
     */
    private $basic;

    /**
     * @var Features
     */
    private $features;

    /**
     * FileMetadata constructor.
     * @param null $fileDescriptor
     * @param null $basic
     * @param null $features
     */
    public function __construct(FileDescriptor $fileDescriptor = null, BasicMetadata $basic = null, Features $features = null)
    {
        $this->fileDescriptor = $fileDescriptor;
        $this->basic = $basic;
        $this->features = $features;
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