<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:39
 */

namespace Wix\Mediaplatform\Model\Metadata;

use \DateTime;

/**
 * Class FileDescriptor
 * @package Wix\Mediaplatform\Model\Metadata
 */
class FileDescriptor
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $hash;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $mimeType;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $size;

    /**
     * @var string
     */
    private $acl;

    /**
     * @var DateTime
     */
    private $dateCreated;

    /**
     * @var DateTime
     */
    private $dateUpdated;

    /**
     * FileDescriptor constructor.
     */
    public function __construct()
    {
    }

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