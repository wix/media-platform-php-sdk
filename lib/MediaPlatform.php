<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/05/2017
 * Time: 21:41
 */

namespace Wix\Mediaplatform;


use GuzzleHttp\Client;
use Wix\Mediaplatform\Authentication\Authenticator;
use Wix\Mediaplatform\Configuration\Configuration;
use Wix\Mediaplatform\Http\AuthenticatedHTTPClient;
use Wix\Mediaplatform\Management\FileDownloader;
use Wix\Mediaplatform\Management\FileManager;
use Wix\Mediaplatform\Management\FileUploader;
use Wix\Mediaplatform\Management\JobManager;

/**
 * Class MediaPlatform
 * @package Wix\Mediaplatform
 */
class MediaPlatform
{
    /**
     * @var FileDownloader
     */
    private $fileDownloader;

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var JobManager
     */
    private $jobManager;


    /**
     * MediaPlatform constructor.
     * @param $domain
     * @param $appId
     * @param $sharedSecret
     * @param Client|null $httpClient
     */
    public function __construct($domain, $appId, $sharedSecret, Client $httpClient = null) {
        $configuration = new Configuration($domain, $appId, $sharedSecret);
        $authenticator = new Authenticator($configuration);
        if(is_null($httpClient)) {
            $httpClient = $this->getHttpClient();
        }

        $authenticatedHTTPClient = new AuthenticatedHTTPClient($authenticator, $httpClient);

        $fileUploader = new FileUploader($configuration, $authenticatedHTTPClient);
        $this->fileDownloader = new FileDownloader($configuration, $authenticator);
        $this->fileManager = new FileManager($configuration, $authenticatedHTTPClient, $fileUploader);
        $this->jobManager = new JobManager($configuration, $authenticatedHTTPClient);
}


    /**
     * @return FileDownloader
     */
    public function fileDownloader() {
        return $this->fileDownloader;
    }

    /**
     * @return FileManager
     */
    public function fileManager() {
        return $this->fileManager;
    }

    /**
     * @return JobManager
     */
    public function jobManager() {
        return $this->jobManager;
    }

    /**
     * @return Client
     */
    protected static function getHttpClient() {
        $httpClient = new Client();
        return $httpClient;
    }
}