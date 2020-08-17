<?php


namespace Wix\Mediaplatform\Model\Job;


use Wix\Mediaplatform\Model\Response\RestResponse;

class FileImportJob extends Job
{
    /**
     * @var string
     */
    public static $job_type = "urn:job:import.file";

    /**
     * @var ImportFileSpecification
     */
    protected $specification;

    /**
     * @var RestResponse
     */
    protected $result;

    public function __construct(Array $payload) {
        parent::__construct($payload);
        $this->result = $payload['result'] ? new RestResponse($payload['result'], 'Wix\Mediaplatform\Model\Metadata\FileDescriptor') : null;
        $this->specification = isset($payload['specification']) ? new ImportFileSpecification($payload['specification']) : null;
    }

    /**
     * @return ImportFileSpecification
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
}