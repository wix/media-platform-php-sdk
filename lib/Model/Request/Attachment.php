<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:00
 */

namespace Wix\Mediaplatform\Model\Request;


/**
 * Class Attachment
 * @package Wix\Mediaplatform\Model\Request
 */
class Attachment
{
    /**
     * @var string
     */
    private $filename;

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