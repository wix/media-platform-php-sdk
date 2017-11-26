<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:14
 */

namespace Wix\Mediaplatform\Model\Request;

/**
 * Class ExtractImageFeaturesRequest
 * @package Wix\Mediaplatform\Model\Request
 */
class ExtractImageFeaturesRequest extends BaseRequest
{
    /**
     * @var string
     */
    private $fileId;

    /**
     * @var string
     */
    private $path;

    /**
     * @var array[string]
     * @enum Wix\Mediaplatform\Model\Request\Enum\ImageFeatureExtractors
     */
    private $features;

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     * @param string
     */
    public function setFileId($fileId)
    {
        $this->fileId = $fileId;
    }

    /**
     * @return array
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @param array $features
     */
    public function setFeatures($features)
    {
        $this->features = $features;
    }


    /**
     * @param $feature string
     */
    public function addFeature($feature) {
        if(!$this->features) {
            $this->features = array();
        }

        $this->features[] = $feature;
    }


    /**
     * @return array
     */
    public function toParams()
    {
        $params = array();

        if ($this->features != null) {
            $params["features"] = join(',', $this->features);
        }

        if ($this->fileId != null) {
            $params["fileId"] = $this->fileId;
        }

        if ($this->path != null) {
            $params["path"] = $this->path;
        }

        return $params;
    }
}