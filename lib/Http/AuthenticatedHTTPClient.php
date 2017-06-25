<?php
namespace Wix\Mediaplatform\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Wix\Mediaplatform\Authentication\Authenticator;
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
        try {
            $response = $this->httpClient->send($request, $options);
            if ($response->getStatusCode() == 200) {
                $jsonArray = \GuzzleHttp\json_decode($response->getBody(), true);
                return new RestResponse($jsonArray);
            }
        } catch (GuzzleException $e) {
            throw $e;
        }
    }

    /**
     * @param $url
     * @param $params
     * @return RestResponse
     */
    public function get($url, $params = array()) {
        $options = array('Authorization' => $this->authenticator->getHeader());
        $request = new Request("GET", $url, $options);

        return $this->send($request, array('query' => $params));
    }


    public function post($url, $params = array(), $options = array()) {
        if(is_object($params) && method_exists($params, 'toArray')) {
            $params = $params->toArray();
        }

        $headers = array('Authorization' => $this->authenticator->getHeader());
        $request = new Request("POST", $url, $headers, json_encode($params));
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