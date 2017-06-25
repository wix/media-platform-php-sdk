<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:28
 */

namespace Wix\Mediaplatform\Model\Request;


/**
 * Class UploadRequest
 * @package Wix\Mediaplatform\Model\Request
 */
class UploadRequest extends BaseRequest
{
    /**
     * @var string
     */
    protected $mimeType = "application/octet-stream";

    /**
     * @var string
     */
    protected $acl = "public";

    /**
     * UploadRequest constructor.
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
     * @return UploadRequest
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @return string
     */
    public function getAcl()
    {
        return $this->acl;
    }

    /**
     * @param string $acl
     * @return UploadRequest
     */
    public function setAcl($acl)
    {
        $this->acl = $acl;
        return $this;
    }
}