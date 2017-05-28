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
class ListFilesResponse extends BaseResponse
{
    /**
     * @var string
     */
    protected $nextPageToken;

    /**
     * @var array[FileDescriptor]
     */
    protected $files;

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