<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 12:45
 */

namespace Wix\Mediaplatform\Model\Job;


/**
 * Class Audio
 * @package Wix\Mediaplatform\Model\Job
 */
class Audio
{
    /**
     * @var AudioSpecification
     */
    private $specification;

    /**
     * Audio constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return AudioSpecification
     */
    public function getSpecification()
    {
        return $this->specification;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return "Audio{" .
            "specification=" . $this->specification .
            '}';
    }
}