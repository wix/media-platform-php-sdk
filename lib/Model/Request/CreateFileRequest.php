<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:05
 */

namespace Wix\Mediaplatform\Model\Request;


/**
 * Class CreateFileRequest
 * @package Wix\Mediaplatform\Model\Request
 */
class CreateFileRequest extends BaseRequest
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $mimeType = "application/vnd.wix-media.dir";

    /**
     * @var string
     */
    protected $type = "d";

    /**
     * @var int
     */
    protected $size;

    /**
     * @var string
     */
    protected $acl = "public";

    /**
     * CreateFileRequest constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param string $path
     * @return CreateFileRequest
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param string $mimeType
     * @return CreateFileRequest
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @param string $type
     * @return CreateFileRequest
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param int $size
     * @return CreateFileRequest
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @param string $acl
     * @return CreateFileRequest
     */
    public function setAcl($acl)
    {
        $this->acl = $acl;
        return $this;
    }
}