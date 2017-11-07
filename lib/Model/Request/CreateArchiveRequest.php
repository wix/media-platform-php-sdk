<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 01/06/2017
 * Time: 11:51
 */

namespace Wix\Mediaplatform\Model\Request;


use Wix\Mediaplatform\Model\Job\Destination;
use Wix\Mediaplatform\Model\Job\Source;

/**
 * Class CreateArchiveRequest
 * @package Wix\Mediaplatform\Model\Request
 */
class CreateArchiveRequest extends BaseRequest
{
    /**
     * @var array
     */
    protected $sources = array();

    /**
     * @var Destination
     */
    protected $destination;

    /**
     * @var string
     */
    protected $archiveType;

    /**
     * ExtractArchiveRequest constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param array
     * @return CreateArchiveRequest
     */
    public function setSources(array $sources)
    {
        $this->sources = $sources;
        return $this;
    }

    /**
     * @param Destination $destination
     * @return CreateArchiveRequest
     */
    public function setDestination(Destination $destination)
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @param Source $source
     * @return $this
     */
    public function addSource(Source $source) {
        $this->sources[] = $source;
        return $this;
    }


    /**
     * @param string $archiveType
     * @return CreateArchiveRequest
     */
    public function setArchiveType($archiveType)
    {
        $this->archiveType = $archiveType;
        return $this;
    }
}