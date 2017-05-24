<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:06
 */

namespace Wix\Mediaplatform\Model\Job;


class Source
{
    /**
     * @var string
     */
    private $fileId;

    /**
     * @var string
     */
    private $path;

    /**
     * Source constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param string $fileId
     * @return Source $this
     */
    public function setFileId($fileId)
    {
        $this->fileId = $fileId;
        return $this;
    }

    /**
     * @param string $path
     * @return Source $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}