<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 12:51
 */

namespace Wix\Mediaplatform\Model\Job;


/**
 * Class Resolution
 * @package Wix\Mediaplatform\Model\Job
 */
class Resolution
{
    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return Resolution
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return Resolution
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }


}