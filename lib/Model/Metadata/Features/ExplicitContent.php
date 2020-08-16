<?php


namespace Wix\Mediaplatform\Model\Metadata\Features;

use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class ExplicitContent
 * @package Wix\Mediaplatform\Model\Metadata\Features
 */
class ExplicitContent extends BaseModel
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $likelihood;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLikelihood()
    {
        return $this->likelihood;
    }

    /**
     * @param string $likelihood
     */
    public function setLikelihood($likelihood)
    {
        $this->likelihood = $likelihood;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return "ExplicitContent{" .
            "name=" . $this->name .
            ", likelyhood=" . $this->likelihood .
            '}';
    }
}