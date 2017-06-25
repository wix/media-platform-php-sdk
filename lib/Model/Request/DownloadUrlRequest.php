<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:09
 */

namespace Wix\Mediaplatform\Model\Request;


/**
 * Class DownloadUrlRequest
 * @package Wix\Mediaplatform\Model\Request
 */
class DownloadUrlRequest extends BaseRequest
{
    /**
     * @var int
     */
    protected $ttl;

    /**
     * @var Attachment
     */
    protected $attachment;

    /**
     * @var string
     */
    protected $onExpireRedirectTo;

    /**
     * DownloadUrlRequest constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @param int $ttl
     * @return DownloadUrlRequest
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
        return $this;
    }

    /**
     * @return Attachment
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @param Attachment $attachment
     * @return DownloadUrlRequest
     */
    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;
        return $this;
    }

    /**
     * @return string
     */
    public function getOnExpireRedirectTo()
    {
        return $this->onExpireRedirectTo;
    }

    /**
     * @param string $onExpireRedirectTo
     * @return DownloadUrlRequest
     */
    public function setOnExpireRedirectTo($onExpireRedirectTo)
    {
        $this->onExpireRedirectTo = $onExpireRedirectTo;
        return $this;
    }
}