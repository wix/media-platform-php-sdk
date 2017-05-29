<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:33
 */

namespace Wix\Mediaplatform\Model\Response;
use Wix\Mediaplatform\Model\BaseModel;
use Wix\Mediaplatform\Model\Metadata\FileDescriptor;


/**
 * Class ListFilesResponse
 * @package Wix\Mediaplatform\Model\Response
 */
class ListFilesResponse extends BaseModel
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
    public function __construct(Array $payload)
    {
        parent::__construct($payload);
        $this->files = array();
        if(is_array($payload['files']) && !empty($payload['files'])) {
            foreach($payload['files'] as $file) {
                $this->files[] = new FileDescriptor($file);
            }
        }
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