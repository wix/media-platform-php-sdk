<?php


namespace Wix\Mediaplatform\Model\Metadata;

use DateTime;
use Wix\Mediaplatform\Model\BaseModel;

/**
 * Class FileDescriptor
 * @package Wix\Mediaplatform\Model\Metadata
 */
class WatermarkManifest extends BaseModel
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return "WatermarkManifest{" .
            "id='" . $this->id . '\'' .
            '}';
    }
}