<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 12:54
 */

namespace Wix\Mediaplatform\Model\Job;


use Wix\Mediaplatform\Model\Response\RestResponse;

/**
 * Class TranscodeJob
 * @package Wix\Mediaplatform\Model\Job
 */
class TranscodeJob extends Job
{
    /**
     * @var string
     */
    public static $job_type = "urn:job:av.transcode";

    /**
     * @var TranscodeSpecification
     */
    protected $specification;

    /**
     * @var RestResponse<TranscodeJobResult>
     */
    protected $result;

    public function __construct(Array $payload) {
        parent::__construct($payload);
        $this->specification = new TranscodeSpecification($payload);
    }


    /**
     * @return TranscodeSpecification
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