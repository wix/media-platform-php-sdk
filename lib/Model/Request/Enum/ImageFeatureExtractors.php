<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:20
 */

namespace Wix\Mediaplatform\Model\Request\Enum;


class ImageFeatureExtractors
{
    const FACIAL_DETECTION = "faces";
    const LABEL_DETECTION = "labels";
    const COLOR_DETECTION = "colors";
    const EXPLICIT_CONTENT_DETECTION = "explicit_content";
}