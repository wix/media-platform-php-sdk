<?php


namespace Wix\Mediaplatform\Model\Request;


use Wix\Mediaplatform\Model\Job\Destination;
use Wix\Mediaplatform\Model\Job\Source;

/**
 * Class ExtractArchiveRequest
 * @package Wix\Mediaplatform\Model\Request
 */
class ExtractArchiveRequest extends BaseAsyncRequest
{
    /**
     * @var Source
     */
    protected $source;

    /**
     * @var Destination
     */
    protected $destination;

    /**
     * ExtractArchiveRequest constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param Source $source
     * @return ExtractArchiveRequest
     */
    public function setSource(Source $source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @param Destination $destination
     * @return ExtractArchiveRequest
     */
    public function setDestination(Destination $destination)
    {
        $this->destination = $destination;
        return $this;
    }
}