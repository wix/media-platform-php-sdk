<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 01/06/2017
 * Time: 11:42
 */

namespace Wix\Mediaplatform\Model\Job;


use Wix\Mediaplatform\Model\BaseModel;

/**
 * Class ExtractArchiveSpecification
 * @package Wix\Mediaplatform\Model\Job
 */
class ExtractArchiveSpecification extends BaseModel
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
     * ExtractArchiveSpecification constructor.
     */
    public function __construct(Array $payload)
    {
        parent::__construct($payload);
        $this->source = new Source($payload['source']);
        $this->destination = new Destination($payload['destination']);
    }


    /**
     * @return Source
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return Destination
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "ExtractArchiveSpecification{" .
            "source=" . $this->source .
            ", destination=" . $this->destination .
            '}';
    }
}