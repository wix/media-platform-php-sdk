<?php


namespace Wix\Mediaplatform\Configuration;


/**
 * Class Configuration
 * @package Wix\Mediaplatform\Configuration
 */
class Configuration
{
    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $appId;

    /**
     * @var string
     */
    private $sharedSecret;

    /**
     * Configuration constructor.
     * @param $domain
     * @param $appId
     * @param $sharedSecret
     */
    public function __construct($domain, $appId, $sharedSecret)
    {
        $this->domain = $domain;
        $this->appId = $appId;
        $this->sharedSecret = $sharedSecret;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getSharedSecret()
    {
        return $this->sharedSecret;
    }
}