<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 17:35
 */

namespace Wix\Mediaplatform\Model\Metadata\Features;


class ImageFeatures implements Features
{
    /**
     * @var array[Label]
     */
    private $label;

    /**
     * @var array[Rectangle]
     */
    private $faces;

    /**
     * @var array[Color]
     */
    private $colors;

    public function __toString()
    {
        return "ImageFeatures{" .
            "label=" . join(',', $this->label) .
            ", faces=" . join(',', $this->faces) .
            ", colors=" . join(',', $this->colors) .
            '}';
    }
}