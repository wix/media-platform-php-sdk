<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:11
 */

namespace Wix\Mediaplatform\Model\Request;


class ExternalAuthorization
{
    /**
     * @var array<string|string>
     */
    private $headers = array();

    public function __construct()
    {
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return ExternalAuthorization
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param $name string
     * @param $value string
     * @return ExternalAuthorization
     * @internal param array $headers
     */
    public function addHeader($name, $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }
}