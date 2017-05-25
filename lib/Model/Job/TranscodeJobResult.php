<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 12:57
 */

namespace Wix\Mediaplatform\Model\Job;


use Wix\Mediaplatform\Model\Metadata\FileDescriptor;

/**
 * Class TranscodeJobResult
 * @package Wix\Mediaplatform\Model\Job
 */
class TranscodeJobResult
{
    /**
     * @var VideoInfo
     */
    private $info;

    /**
     * @var FileDescriptor
     */
    private $file;

    /**
     * TranscodeJobResult constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return VideoInfo
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @return FileDescriptor
     */
    public function getFile()
    {
        return $this->file;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return "TranscodeJobResult{" .
            "info=" . $this->info .
            ", file=" . $this->file .
            '}';
    }
}