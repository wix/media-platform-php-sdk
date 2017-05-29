<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 16:58
 */

namespace Wix\Mediaplatform\Model\Job;


use Wix\Mediaplatform\Model\BaseModel;

class ImportFileSpecification extends BaseModel implements Specification
{
    /**
     * @var string
     */
    protected $sourceUrl;

    /**
     * @var Destination
     */
    protected $destination;

    /**
     * ImportFileSpecification constructor.
     */
    public function __construct(Array $payload) {
        parent::__construct($payload);
        $this->destination = isset($payload['destination']) ? new Destination($payload['destination']) : null;
    }

    /**
     * @return string
     */
    public function getSourceUrl() {
        return $this->sourceUrl;
    }

    /**
     * @return Destination
     */
    public function getDestination() {
        return $this->destination;
    }

    /**
     * @return string
     */
    public function __toString() {
        return "ImportFileSpecification{" .
            "sourceUrl='" . $this->sourceUrl . '\'' .
            ", destination=" . $this->destination .
            '}';
    }

}