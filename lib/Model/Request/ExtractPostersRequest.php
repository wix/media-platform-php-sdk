<?php


namespace Wix\Mediaplatform\Model\Request;


use Wix\Mediaplatform\Model\Job\ExtractPostersSpecification;
use Wix\Mediaplatform\Model\Job\Source;

/**
 * Class ExtractPostersRequest
 * @package Wix\Mediaplatform\Model\Request
 */
class ExtractPostersRequest extends BaseAsyncRequest
{
    /**
     * @var array
     */
    protected $sources = array();

    /**
     * @var ExtractPostersSpecification[]
     */
    protected $specifications = array();

    /**
     * ExtractPostersRequest constructor.
     */
    public function __construct()
    {
    }

    public function toArray() {
        $vars = parent::toArray();

        /**
         * @var $source Source
         */
        foreach($vars['sources'] as $key => $source) {
            $vars['sources'][$key] = $source->toArray();
        }

        /**
         * @var $specification ExtractPostersSpecification
         */
        foreach($vars['specifications'] as $key => $specification) {
            $vars['specifications'][$key] = $specification->toArray();
        }

        return $vars;
    }

    /**
     * @param array $sources
     * @return $this
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
     * @param ExtractPostersSpecification[] $specifications
     * @return $this
     */
    public function setSpecifications(array $specifications)
    {
        $this->specifications = $specifications;
        return $this;
    }


    /**
     * @param ExtractPostersSpecification $specification
     * @return $this
     */
    public function addSpecification(ExtractPostersSpecification $specification)
    {
        $this->specifications[] = $specification;
        return $this;
    }
}