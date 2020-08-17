<?php


namespace Wix\Mediaplatform\Model\Metadata\Features;

use Wix\Mediaplatform\Geometry\Rectangle;
use Wix\Mediaplatform\Model\BaseModel;

class ImageFeatures extends BaseModel implements Features
{
    /**
     * @var array[Label]
     */
    protected $labels;

    /**
     * @var array[Rectangle]
     */
    protected $faces;

    /**
     * @var array[Color]
     */
    protected $colors;

    /**
     * @var array[ExplicitContent]
     */
    protected $explicitContent;

    /**
     * ImageFeatures constructor.
     * @param array $payload
     */
    public function __construct(Array $payload) {
        parent::__construct($payload);

        $this->labels = array();
        if(is_array($payload['labels']) && !empty($payload['labels'])) {
            foreach($payload['labels'] as $label) {
                $this->labels[] = new Label($label);
            }
        }

        $this->faces = array();
        if(is_array($payload['faces']) && !empty($payload['faces'])) {
            foreach($payload['faces'] as $face) {
                $this->faces[] = new Rectangle($face);
            }
        }

        $this->colors = array();
        if(is_array($payload['colors']) && !empty($payload['colors'])) {
            foreach($payload['colors'] as $color) {
                $this->colors[] = new Color($color);
            }
        }

        $this->explicitContent = array();
        if(!empty($payload['explicitContent']) && is_array($payload['explicitContent'])) {
            foreach($payload['explicitContent'] as $explicitContent) {
                $this->explicitContent[] = new ExplicitContent($explicitContent);
            }
        }
    }

    /**
     * @return array
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * @return array
     */
    public function getFaces()
    {
        return $this->faces;
    }

    /**
     * @return array
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @return array
     */
    public function getExplicitContent()
    {
        return $this->explicitContent;
    }


    public function __toString()
    {
        return "ImageFeatures{" .
            "labels=" . join(',', $this->labels) .
            ", faces=" . join(',', $this->faces) .
            ", colors=" . join(',', $this->colors) .
            ", explicitContent=" . join(',', $this->explicitContent) .
            '}';
    }
}