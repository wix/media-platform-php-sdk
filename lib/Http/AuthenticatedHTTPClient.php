<?php
namespace Wix\Mediaplatform\Http;

use GuzzleHttp\Exception\GuzzleException;
use Wix\Mediaplatform\Authentication\Authenticator;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Wix\Mediaplatform\Model\Response\RestResponse;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/05/2017
 * Time: 13:36
 */
class AuthenticatedHTTPClient
{
    /**
     * @var string
     */
    const ACCEPT_JSON = "Accept: application/json";

    /**
     * @var string
     */
    const CONTENT_TYPE_JSON = "Content-Type: application/json";

    /**
     * @var Authenticator
     */
    private $authenticator;

    /**
     * @var Client
     */
    private $httpClient;

    public function __construct(Authenticator $authenticator, Client $httpClient)
    {
        $this->authenticator = $authenticator;
        $this->httpClient = $httpClient;
    }

    public function send(Request $request, Array $options = array()) {
        $response = $this->httpClient->send($request, $options);
        if($response->getStatusCode() == 200) {
            $jsonArray = \GuzzleHttp\json_decode($response->getBody(), true);
            return new RestResponse($jsonArray);
        }
    }

    /**
     * @param $url
     * @param $params
     * @return RestResponse
     */
    public function get($url, $params = array()) {
        $params['Authorization'] = $this->authenticator->getHeader();
        $request = new Request("GET", $url, $params);

        return $this->send($request);
    }


    public function post($url, $params = array(), $options = array()) {
        if(is_object($params)) {
            $params = $params->toArray();
        }

        $params['Authorization'] = $this->authenticator->getHeader();
        $request = new Request("POST", $url, $params);
        return $this->send($request, $options);
    }

    public function delete($url, $params = array(), $options = array()) {
        if(is_object($params)) {
            $params = $params->toArray();
        }

        $params['Authorization'] = $this->authenticator->getHeader();
        $request = new Request("DELETE", $url, $params);
        return $this->send($request, $options);
    }
}