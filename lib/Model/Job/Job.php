<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 16:45
 */

namespace Wix\Mediaplatform\Model\Job;

abstract class Job
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $issuer;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $groupId;

    /**
     * @var array[string]
     */
    private $sources;

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getIssuer() {
        return $this->issuer;
    }

    /**
     * @return string
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getGroupId() {
        return $this->groupId;
    }

    /**
     * @return array
     */
    public function getSources() {
        return $this->sources;
    }

    /**
     * @return Specification
     */
    public abstract function getSpecification();

    /**
     * @return RestResponse
     */
    public abstract function getResult();

    public function __tostring() {
        return "Job{" .
            "id='" . $this->id . '\'' .
            ", type='" . $this->type . '\'' .
            ", issuer='" . $this->issuer . '\'' .
            ", status='" . $this->status . '\'' .
            ", groupId='" . $this->groupId . '\'' .
            ", sources=" . join(',', $this->sources) .
            ", specification=" . $this->getSpecification() .
            ", result=" . $this->getResult() .
            '}';
    }
}