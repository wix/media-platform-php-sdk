<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:14
 */

namespace Wix\Mediaplatform\Model\Request;


use Wix\Mediaplatform\Model\Job\Destination;

/**
 * Class ImportFileRequest
 * @package Wix\Mediaplatform\Model\Request
 */
class ImportFileRequest extends BaseRequest
{
    /**
     * @var string
     */
    protected $sourceUrl;

    /**
     * @var ExternalAuthorization
     */
    protected $externalAuthorization;

    /**
     * @var Destination
     */
    protected $destination;

    /**
     * ImportFileRequest constructor.
     * @return ImportFileRequest
     */
    public function __construct()
    {
        return $this;
    }

    /**
     * @param string $sourceUrl
     * @return ImportFileRequest
     */
    public function setSourceUrl($sourceUrl)
    {
        $this->sourceUrl = $sourceUrl;
        return $this;
    }

    /**
     * @param ExternalAuthorization $externalAuthorization
     * @return ImportFileRequest
     */
    public function setExternalAuthorization($externalAuthorization)
    {
        $this->externalAuthorization = $externalAuthorization;
        return $this;
    }

    /**
     * @param Destination $destination
     * @return ImportFileRequest
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
        return $this;
    }
}