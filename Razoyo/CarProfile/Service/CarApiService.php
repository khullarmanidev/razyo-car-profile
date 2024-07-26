<?php

declare(strict_types=1);

namespace Razoyo\CarProfile\Service;

use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Magento\Framework\Webapi\Rest\Request;

/**
 * Class CarApiService
 */
class CarApiService
{
    /**
     * API request URL
     */
    const API_REQUEST_URI = 'https://exam.razoyo.com/api/';

    /**
     * API request endpoint
     */
    const API_REQUEST_ENDPOINT = 'cars/';

    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @var ClientFactory
     */
    private $clientFactory;

    /**
     * GitApiService constructor
     *
     * @param ClientFactory $clientFactory
     * @param ResponseFactory $responseFactory
     */
    public function __construct(
        ClientFactory $clientFactory,
        ResponseFactory $responseFactory
    ) {
        $this->clientFactory = $clientFactory;
        $this->responseFactory = $responseFactory;
    }

    /**
     * Fetch some data from API
     */
    public function execute()
    {
        return $this->getCarList(static::API_REQUEST_ENDPOINT);
    }

    /**
     * Do API request with provided params
     *
     * @param string $uriEndpoint
     * @param array $params
     * @param string $requestMethod
     *
     * @return Response
     */
    private function getCarList(
        string $uriEndpoint,
        array $params = [],
        string $requestMethod = Request::HTTP_METHOD_GET
    ): Response {
        /** @var Client $client */
        $client = $this->clientFactory->create(['config' => [
            'base_uri' => self::API_REQUEST_URI
        ]]);

        try {
            $response = $client->request(
                $requestMethod,
                $uriEndpoint,
                $params
            );
        } catch (GuzzleException $exception) {
            /** @var Response $response */
            $response = $this->responseFactory->create([
                'status' => $exception->getCode(),
                'reason' => $exception->getMessage()
            ]);
        }

        return $response;
    }

    /**
     * @param string $id
     * @param array $params
     * @param string $uriEndpoint
     * @param string $requestMethod
     * @return Response|\Psr\Http\Message\ResponseInterface
     */
    public function getCarListById(
        string $id,
        array $params = [],
        string $uriEndpoint = CarApiService::API_REQUEST_ENDPOINT,
        string $requestMethod = Request::HTTP_METHOD_GET
    ){
        /** @var Client $client */
        $client = $this->clientFactory->create(['config' => [
            'base_uri' => self::API_REQUEST_URI
        ]]);

        try {
            $tokenResponse = $this->getCarList(static::API_REQUEST_ENDPOINT);
            $tokenResponse = $tokenResponse->getHeaders();
            $token = $tokenResponse['your-token'][0];
            $params['headers'] = [
                'Authorization' => 'Bearer ' . $token
            ];
            $uriEndpoint .= urlencode($id);
            $response = $client->request(
                $requestMethod,
                $uriEndpoint,
                $params
            );
        } catch (GuzzleException $exception) {
            /** @var Response $response */
            $response = $this->responseFactory->create([
                'status' => $exception->getCode(),
                'reason' => $exception->getMessage()
            ]);
        }
        return $response;
    }
}
