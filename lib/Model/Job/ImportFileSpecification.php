<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 16:58
 */

namespace Wix\Mediaplatform\Model\Job;


class ImportFileSpecification implements Specification
{
    /**
     * @var string
     */
    private $sourceUrl;

    /**
     * @var Destination
     */
    private $destination;

    /**
     * ImportFileSpecification constructor.
     */
    public function __construct() {
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