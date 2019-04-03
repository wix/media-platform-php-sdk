<?php


namespace Wix\Mediaplatform\Model\Job;


use Wix\Mediaplatform\Model\Response\RestResponse;

/**
 * Class ExtractPostersJob
 * @package Wix\Mediaplatform\Model\Job
 */
class ExtractPostersJob extends Job
{
    /**
     * @var string
     */
    public static $job_type = "urn:job:av.poster";

    /**
     * @var ExtractPostersSpecification
     */
    protected $specification;

    /**
     * @var RestResponse<ExtractPostersJobResult>
     */
    protected $result;

    public function __construct(Array $payload = null) {
        parent::__construct($payload);
        $this->result = $payload && !empty($payload['result']) ? new RestResponse($payload['result']) : null;
        $this->specification = $payload && !empty($payload['specification']) ? new ExtractPostersSpecification($payload['specification']) : null;
    }


    /**
     * @return ExtractPostersSpecification
     */
    public function getSpecification() {
        return $this->specification;
    }

    /**
     * @return RestResponse
     */
    public function getResult() {
        return $this->result;
    }
}?>