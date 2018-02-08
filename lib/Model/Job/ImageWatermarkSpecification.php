<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 16:58
 */

namespace Wix\Mediaplatform\Model\Job;


use Wix\Mediaplatform\Model\BaseModel;

class ImageWatermarkSpecification extends BaseModel implements Specification
{
    /**
     * @var Source
     */
    protected $watermark;

    /**
     * @var integer
     */
    protected $position;

    /**
     * @var integer
     */
    protected $opacity;

    /**
     * @enum ImageWatermarkPosition
     * @var integer
     */
    protected $scale;

    /**
     * ImageWatermarkSpecification constructor.
     * @param array $payload
     */
    public function __construct(Array $payload = array()) {
        parent::__construct($payload);
        $this->watermark = isset($payload['source']) ? new Source($payload['source']) : null;
    }

    /**
     * @return Source
     */
    public function getWatermark()
    {
        return $this->watermark;
    }

    /**
     * @param Source $watermark
     * @return ImageWatermarkSpecification
     */
    public function setWatermark($watermark)
    {
        $this->watermark = $watermark;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return ImageWatermarkSpecification
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return int
     */
    public function getOpacity()
    {
        return $this->opacity;
    }

    /**
     * @param int $opacity
     * @return ImageWatermarkSpecification
     */
    public function setOpacity($opacity)
    {
        $this->opacity = $opacity;
        return $this;
    }

    /**
     * @return int
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * @param int $scale
     * @return ImageWatermarkSpecification
     */
    public function setScale($scale)
    {
        $this->scale = $scale;
        return $this;
    }

    /**
     * @return array
     */
    public function toParams()
    {
        $params = array();

        if ($this->watermark != null) {
            $params["watermark"] = $this->watermark;
        }

        if ($this->position != null) {
            $params["position"] = $this->position;
        }

        if ($this->opacity != null) {
            $params["opacity"] = $this->opacity;
        }

        if ($this->scale != null) {
            $params["scale"] = $this->scale;
        }

        return $params;
    }


    /**
     * @return string
     */
    public function __toString() {
        return "ImageWatermarkSpecification{" .
            "watermark='" . $this->watermark . '\'' .
            ", position='" . $this->position . '\'' .
            ", opacity='" . $this->opacity . '\'' .
            ", scale=" . $this->scale .
            '}';
    }

}