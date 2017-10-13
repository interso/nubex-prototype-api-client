<?php

namespace Interso\NubexPrototypeAPI;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ServerException;

class Client
{

    const METHOD_GET = 'GET';

    const METHOD_POST = 'POST';

    const METHOD_PUT = 'PUT';

    const METHOD_DELETE = 'DELETE';

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $httpOptions = [];


    public function __construct($baseUrl, $apiKey, ClientInterface $httpClient)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient;
    }


    /**
     * Prepares URI for the request.
     *
     * @param string $endpoint
     *
     * @return string
     */
    protected function prepareUri($endpoint)
    {
        return $this->baseUrl.'/'.$endpoint;
    }


    /**
     * Requests API.
     *
     * @param        $uri
     * @param array  $params
     * @param string $method
     *
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \RuntimeException
     */
    public function query($uri, array $params = [], $method = self::METHOD_POST)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Api-Key'      => $this->apiKey,
        ];

        $request = new Request($method, $uri, $headers, 0 < count($params) ? json_encode($params) : null);

        try {
            $response = $this->httpClient->send($request, $this->httpOptions);
        } catch (ServerException $exception) {
            $responseBody = $exception->getResponse()->getBody();
            $result = ['success' => false, 'exception' => $exception, 'body' => (string)$responseBody];

            return $result;
        } catch (\Exception $exception) {
            $result = ['success' => false, 'exception' => $exception];

            return $result;
        }

        $body = (string)$response->getBody();
        $result = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Error parsing response: '.json_last_error_msg().'Body: '.$body);
        }

        return $result;
    }

}
