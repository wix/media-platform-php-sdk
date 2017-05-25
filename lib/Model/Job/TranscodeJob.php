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
    private $specification;

    /**
     * @var RestResponse<TranscodeJobResult>
     */
    private $result;

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