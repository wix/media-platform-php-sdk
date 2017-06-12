<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:14
 */

namespace Wix\Mediaplatform\Model\Request;


use Wix\Mediaplatform\Model\Job\Destination;
use Wix\Mediaplatform\Model\Job\Source;
use Wix\Mediaplatform\Model\Job\TranscodeJobResult;
use Wix\Mediaplatform\Model\Job\TranscodeSpecification;

/**
 * Class TranscodeFileRequest
 * @package Wix\Mediaplatform\Model\Request
 */
class TranscodeRequest extends BaseRequest
{
    /**
     * @var array
     */
    protected $sources = array();

    /**
     * @var array
     */
    protected $specifications = array();

    /**
     * TranscodeRequest constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param array $sources
     * @return TranscodeRequest
     */
    public function setSources(array $sources)
    {
        $this->sources = $sources;
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
     * @param array $specifications
     * @return TranscodeRequest
     */
    public function setSpecifications(array $specifications)
    {
        $this->specifications = $specifications;
        return $this;
    }


    /**
     * @param TranscodeSpecification $specification
     * @return TranscodeRequest
     */
    public function addSpecification(TranscodeSpecification $specification)
    {
        $this->specifications[] = $specification;
        return $this;
    }
}