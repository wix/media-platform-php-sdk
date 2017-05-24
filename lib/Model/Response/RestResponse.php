<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:34
 */

namespace Wix\Mediaplatform\Model\Response;


/**
 * Class RestResponse
 * @package Wix\Mediaplatform\Model\Response
 */
class RestResponse
{
    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $message;

    /**
     * @var \stdClass
     */
    private $payload;

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return \stdClass
     */
    public function getPayload()
    {
        return $this->payload;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return "RestResponse{" .
            "code=" . $this->code .
            ", message='" . $this->message . '\'' .
            ", payload=" . $this->payload .
            '}';
    }
}