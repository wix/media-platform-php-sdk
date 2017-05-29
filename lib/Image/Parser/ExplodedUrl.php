<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 18:51
 */

namespace Wix\Mediaplatform\Image\Parser;


use Wix\Mediaplatform\Image\StringToken;

class ExplodedUrl
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $geometry;

    /**
     * @var string
     */
    private $options;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */
    private $fragment;

    /**
     * ExplodedUrl constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $urlComponents = parse_url($url);
        $this->host = !empty($urlComponents['scheme']) ? $urlComponents['scheme'] . "://" : "//";
        $this->host .= !empty($urlComponents['host']) ? $urlComponents['host'] : "";
        $this->host .= (!empty($urlComponents['port']) ? ':' . $urlComponents['port'] : '') . '/';
        $this->fragment = !empty($urlComponents['fragment']) ? $urlComponents['fragment'] : "";

        $parts = !empty($urlComponents['path']) ? explode(StringToken::FORWARD_SLASH, $urlComponents['path']) : array();
        $this->fileName = array_pop($parts);
        $this->options = array_pop($parts);
        $this->geometry = array_pop($parts);
        $this->version = array_pop($parts);
        $this->path = join($parts, StringToken::FORWARD_SLASH);

    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return string
     */
    public function getGeometry()
    {
        return $this->geometry;
    }

    /**
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function getFragment()
    {
        return $this->fragment;
    }
}