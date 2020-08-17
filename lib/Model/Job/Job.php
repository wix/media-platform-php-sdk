<?php


namespace Wix\Mediaplatform\Model\Job;

use Wix\Mediaplatform\Model\BaseModel;
use Wix\Mediaplatform\Model\Response\RestResponse;

abstract class Job extends BaseModel
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $issuer;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $groupId;

    /**
     * @var array[string]
     */
    protected $sources;

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

    public function __construct(Array $payload) {
        parent::__construct($payload);
        $this->sources = array();
        if(!empty($payload['sources']) && is_array($payload['sources'])) {
            foreach($payload['sources'] as $source) {
                $this->sources[] = new Source($source);
            }
        }
    }

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