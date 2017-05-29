<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:37
 */

namespace Wix\Mediaplatform\Model\Metadata\Features;

use Wix\Mediaplatform\Model\BaseModel;


/**
 * Class Label
 * @package Wix\Mediaplatform\Model\Metadata\Features
 */
class Label extends BaseModel
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $score;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return "Label{" .
            "name='" . $this->name . '\'' .
            ", score=" . $this->score .
            '}';
    }
}