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

    public function __construct(Array $response, $payloadType = null) {
        $this->code = $response['code'];
        $this->message = $response['message'];
        if(!is_null($payloadType)) {
            if(is_array($payloadType)) {
                $this->payload = new \stdClass();
                foreach($payloadType as $key => $subType) {
                    if(isset($response['payload'][$key])) {
                        $this->payload->$key = new $subType($response['payload'][$key]);
                    }
                }
            } else {
                $this->payload = new $payloadType($response['payload']);
            }
        } else {
            $this->payload = $response['payload'];
        }
    }

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
     * @return mixed
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