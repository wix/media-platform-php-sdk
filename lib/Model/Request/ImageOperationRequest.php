<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:14
 */

namespace Wix\Mediaplatform\Model\Request;
use Wix\Mediaplatform\Model\Job\ImageOperationSpecification;
use Wix\Mediaplatform\Model\Job\Source;

/**
 * Class ImageOperationRequest
 * @package Wix\Mediaplatform\Model\Request
 */
class ImageOperationRequest extends BaseRequest
{
    /**
     * @var Source
     */
    protected $source;

    /**
     * @var ImageOperationSpecification
     */
    protected $specification;


    /**
     * @return Source
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param Source $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return ImageOperationSpecification
     */
    public function getSpecification()
    {
        return $this->specification;
    }

    /**
     * @param ImageOperationSpecification $specification
     */
    public function setSpecification($specification)
    {
        $this->specification = $specification;
    }


    /**
     * @return array
     */
    public function toParams()
    {
        $params = array();

        if ($this->source != null) {
            $params["source"] = $this->source->toArray();
        }

        if ($this->specification != null) {
            $params["specification"] = $this->specification->toArray();
        }

        return $params;
    }
}