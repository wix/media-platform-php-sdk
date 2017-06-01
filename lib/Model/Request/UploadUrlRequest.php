<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:29
 */

namespace Wix\Mediaplatform\Model\Request;


class UploadUrlRequest
{
    /**
     * @var string
     */
    private $mimeType;

    /**
     * @var string
     */
    private $path;

    /**
     * UploadUrlRequest constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     * @return UploadUrlRequest
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return UploadUrlRequest
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }


    /**
     * @return array
     */
    public function toParams()
    {
        $params = array();

        if ($this->mimeType != null) {
            $params["mimeType"] = $this->mimeType;
        }

        if ($this->path != null) {
            $params["path"] = $this->path;
        }

        return $params;
    }
}