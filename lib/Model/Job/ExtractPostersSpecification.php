<?php


namespace Wix\Mediaplatform\Model\Job;

use Wix\Mediaplatform\Model\BaseModel;

/**
 * Class ExtractPostersSpecification
 * @package Wix\Mediaplatform\Model\Job
 */
class ExtractPostersSpecification extends BaseModel implements Specification
{

    /**
     * @var Destination
     */
    protected $destination;



    /**
     * @var string
     */
    protected $format;

    /**
     * @var int
     */
    protected $second;

    /**
     * ExtractPostersSpecification constructor.
     */
    public function __construct(Array $payload = null) {
        parent::__construct($payload);

        $this->destination  = $payload && !empty($payload['destination']) ? new Destination($payload['destination']) : null;
    }

    /**
     * @param Destination $destination
     * @return $this
     */
    public function setDestination(Destination $destination)
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @param string $format
     *
     * @return $this
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @param int $second
     *
     * @return $this
     */
    public function setSecond($second)
    {
        $this->second = $second;
        return $this;
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
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return int
     */
    public function getSecond()
    {
        return $this->second;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "ExtractPostersSpecification{" .
            "destination=" . $this->destination .
            ", format='" . $this->format . '\'' .
               ", second=" . $this->second .
            '}';
    }
}