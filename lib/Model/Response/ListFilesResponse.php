<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:33
 */

namespace Wix\Mediaplatform\Model\Response;


/**
 * Class ListFilesResponse
 * @package Wix\Mediaplatform\Model\Response
 */
class ListFilesResponse
{
    /**
     * @var string
     */
    private $nextPageToken;

    /**
     * @var array[FileDescriptor]
     */
    private $files;

    /**
     * ListFilesResponse constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getNextPageToken()
    {
        return $this->nextPageToken;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }
}