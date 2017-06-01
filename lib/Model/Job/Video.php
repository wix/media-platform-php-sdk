<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 13:01
 */

namespace Wix\Mediaplatform\Model\Job;

use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class Video
 * @package Wix\Mediaplatform\Model\Job
 */
class Video extends BaseModel
{
    /**
     * @var VideoSpecification
     */
    private $specification;

    /**
     * Video constructor.
     */
    public function __construct(Array $payload) {
        parent::__construct();
        $this->specification = new VideoSpecification($payload);
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