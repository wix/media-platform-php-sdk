<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 16:58
 */

namespace Wix\Mediaplatform\Model\Job;


use Wix\Mediaplatform\Image\Image;
use Wix\Mediaplatform\Model\BaseModel;

class ImageOperationSpecification extends BaseModel implements Specification
{
    /**
     * @var string
     */
    protected $command;

    /**
     * @var Destination
     */
    protected $destination;

    /**
     * ImageOperationSpecification constructor.
     * @param array $payload
     */
    public function __construct(Array $payload = array()) {
        parent::__construct($payload);
        $this->destination = isset($payload['destination']) ? new Destination($payload['destination']) : null;
    }

    /**
     * @return string
     */
    public function getCommand() {
        return $this->command;
    }

    /**
     * @return Destination
     */
    public function getDestination() {
        return $this->destination;
    }

    /**
     * @param Destination $destination
     * @return $this
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
        return $this;
    }


    /**
     * @param $image Image
     * @return $this
     */
    public function setCommand($image) {
        $clonedImage = clone $image;

        $clonedImage->setHost("");
        $clonedImage->setFileName("");
        $clonedImage->setPath("");

        $this->command = rtrim($clonedImage->toUrl(), '/');
        return $this;
    }



    /**
     * @return array
     */
    public function toParams()
    {
        $params = array();

        if ($this->command != null) {
            $params["command"] = $this->command;
        }

        if ($this->destination != null) {
            $params["destination"] = $this->destination->toArray();
        }

        return $params;
    }


    /**
     * @return string
     */
    public function __toString() {
        return "ImageOperationSpecification{" .
            "command='" . $this->command . '\'' .
            ", destination=" . $this->destination .
            '}';
    }

}