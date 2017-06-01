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
    }

    public function __toString()
    {
        return "ImageFeatures{" .
            "labels=" . join(',', $this->labels) .
            ", faces=" . join(',', $this->faces) .
            ", colors=" . join(',', $this->colors) .
            '}';
    }
}