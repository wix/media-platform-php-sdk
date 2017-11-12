<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:35
 */

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
    protected $explicitContents;

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

        $this->explicitContents = array();
        if(!empty($payload['explicitContents']) && is_array($payload['explicitContents'])) {
            foreach($payload['explicitContents'] as $explicitContent) {
                $this->explicitContents[] = new ExplicitContent($explicitContent);
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
    public function getExplicitContents()
    {
        return $this->explicitContents;
    }


    public function __toString()
    {
        return "ImageFeatures{" .
            "labels=" . join(',', $this->labels) .
            ", faces=" . join(',', $this->faces) .
            ", colors=" . join(',', $this->colors) .
            ", explicitContents=" . join(',', $this->explicitContents) .
            '}';
    }
}