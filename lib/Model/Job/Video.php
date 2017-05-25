<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 13:01
 */

namespace Wix\Mediaplatform\Model\Job;


/**
 * Class Video
 * @package Wix\Mediaplatform\Model\Job
 */
class Video
{
    /**
     * @var VideoSpecification
     */
    private $specification;

    /**
     * Video constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return VideoSpecification
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
        return "Video{" .
            "specification=" . $this->specification .
            '}';
    }
}