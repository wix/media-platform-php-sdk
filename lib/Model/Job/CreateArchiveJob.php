<?php


namespace Wix\Mediaplatform\Model\Job;


use Wix\Mediaplatform\Model\Response\RestResponse;

class CreateArchiveJob extends Job
{
    public static $job_type = "urn:job:archive.create";

    /**
     * @var CreateArchiveSpecification
     */
    protected $specification;

    /**
     * @var RestResponse
     */
    protected $result;

    /**
     * CreateArchiveJob constructor.
     * @param $getPayload
     */
    public function __construct(Array $payload = array())
    {
        parent::__construct($payload);
        $this->specification = !empty($payload['specification']) ? new CreateArchiveSpecification($payload['specification']) : null;
        $this->result = !empty($payload['result']) ? new RestResponse($payload['result']) : null;
    }

    /**
     * @return CreateArchiveSpecification
     */
    public function getSpecification()
    {
        return $this->specification;
    }

    /**
     * @return RestResponse
     */
    public function getResult()
    {
        return $this->result;
    }
}