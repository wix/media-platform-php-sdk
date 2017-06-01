<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:31
 */

namespace Wix\Mediaplatform\Model\Response;
use Wix\Mediaplatform\Model\BaseModel;

/**
 * Class GetUploadUrlResponse
 * @package Wix\Mediaplatform\Model\Response
 */
class GetUploadUrlResponse extends BaseModel
{
    /**
     * @var string
     */
    protected $uploadUrl;

    /**
     * @var string
     */
    protected $uploadToken;

    /**
     * GetUploadUrlResponse constructor.
     * @param null $uploadUrl
     * @param null $uploadToken
     */
    public function __construct($uploadUrl = null, $uploadToken = null) {
        // using payload to init the object
        if(is_array($uploadUrl) && !empty($uploadUrl)) {
            parent::__construct($uploadUrl);
        } else {
            $this->uploadUrl = $uploadUrl;
            $this->uploadToken = $uploadToken;
        }
    }

    /**
     * @return string
     */
    public function getUploadUrl()
    {
        return $this->uploadUrl;
    }

    /**
     * @return string
     */
    public function getUploadToken()
    {
        return $this->uploadToken;
    }
}