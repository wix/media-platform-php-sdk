<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 01/06/2017
 * Time: 11:41
 */

namespace Wix\Mediaplatform\Model\Job;


use Wix\Mediaplatform\Model\Response\RestResponse;

class ExtractArchiveJob extends Job
{
    public static $job_type = "urn:job:archive.extract";

    /**
     * @var ExtractArchiveSpecification
     */
    protected $specification;

    /**
     * @var RestResponse
     */
    protected $result;

    /**
     * ExtractArchiveJob constructor.
     * @param $getPayload
     */
    public function __construct(Array $payload = array())
    {
        parent::__construct($payload);
        $this->specification = !empty($payload['specification']) ? new ExtractArchiveSpecification($payload['specification']) : null;
        $this->result = !empty($payload['result']) ? new RestResponse($payload['result']) : null;
    }

    /**
     * @return ExtractArchiveSpecification
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