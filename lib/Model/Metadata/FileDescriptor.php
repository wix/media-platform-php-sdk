<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:39
 */

namespace Wix\Mediaplatform\Model\Metadata;

use \DateTime;
use Wix\Mediaplatform\Model\BaseModel;

/**
 * Class FileDescriptor
 * @package Wix\Mediaplatform\Model\Metadata
 */
class FileDescriptor extends BaseModel
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $mimeType;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var string
     */
    protected $acl;

    /**
     * @var DateTime
     */
    protected $dateCreated;

    /**
     * @var DateTime
     */
    protected $dateUpdated;


    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getAcl()
    {
        return $this->acl;
    }

    /**
     * @return DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @return DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "FileDescriptor{" .
            "id='" . $this->id . '\'' .
            ", hash='" . $this->hash . '\'' .
            ", path='" . $this->path . '\'' .
            ", mimeType='" . $this->mimeType . '\'' .
            ", type='" . $this->type . '\'' .
            ", size=" . $this->size .
            ", acl='" . $this->acl . '\'' .
            ", dateCreated=" . $this->dateCreated->format(DateTime::ISO8601) .
            ", dateUpdated=" . $this->dateUpdated->format(DateTime::ISO8601) .
            '}';
    }
}