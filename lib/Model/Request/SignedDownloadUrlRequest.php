<?php


namespace Wix\Mediaplatform\Model\Request;


/**
 * Class SignedDownloadUrlRequest
 * @package Wix\Mediaplatform\Model\Request
 */
class SignedDownloadUrlRequest extends BaseRequest
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
     * SignedDownloadUrlRequest constructor.
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
     * @return SignedDownloadUrlRequest
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
     * @return SignedDownloadUrlRequest
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
     * @return SignedDownloadUrlRequest
     */
    public function setOnExpireRedirectTo($onExpireRedirectTo)
    {
        $this->onExpireRedirectTo = $onExpireRedirectTo;
        return $this;
    }
}