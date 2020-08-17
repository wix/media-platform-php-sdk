<?php


namespace Wix\Mediaplatform\Model\Request;


/**
 * Class Attachment
 * @package Wix\Mediaplatform\Model\Request
 */
class Attachment extends BaseRequest
{
    /**
     * @var string
     */
    protected $filename;

    /**
     * Attachment constructor.
     */
    public function __construct() {
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     * @return Attachment
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
        return $this;
    }


}