<?php
/**
 * RoutesApi
 * PHP version 5
 *
 * @category Class
 * @package  nullx27\ESI
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * EVE Swagger Interface
 *
 * An OpenAPI for EVE Online
 *
 * OpenAPI spec version: 0.7.3
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.3.1-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace nullx27\ESI\nullx27\ESI\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use nullx27\ESI\ApiException;
use nullx27\ESI\Configuration;
use nullx27\ESI\HeaderSelector;
use nullx27\ESI\ObjectSerializer;

/**
 * RoutesApi Class Doc Comment
 *
 * @category Class
 * @package  nullx27\ESI
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class RoutesApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getRouteOriginDestination
     *
     * Get route
     *
     * @param  int $destination destination solar system ID (required)
     * @param  int $origin origin solar system ID (required)
     * @param  int[] $avoid avoid solar system ID(s) (optional)
     * @param  int[][] $connections connected solar system pairs (optional)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $flag route security preference (optional, default to shortest)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \nullx27\ESI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return int[]
     */
    public function getRouteOriginDestination($destination, $origin, $avoid = null, $connections = null, $datasource = 'tranquility', $flag = 'shortest', $userAgent = null, $xUserAgent = null)
    {
        list($response) = $this->getRouteOriginDestinationWithHttpInfo($destination, $origin, $avoid, $connections, $datasource, $flag, $userAgent, $xUserAgent);
        return $response;
    }

    /**
     * Operation getRouteOriginDestinationWithHttpInfo
     *
     * Get route
     *
     * @param  int $destination destination solar system ID (required)
     * @param  int $origin origin solar system ID (required)
     * @param  int[] $avoid avoid solar system ID(s) (optional)
     * @param  int[][] $connections connected solar system pairs (optional)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $flag route security preference (optional, default to shortest)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \nullx27\ESI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of int[], HTTP status code, HTTP response headers (array of strings)
     */
    public function getRouteOriginDestinationWithHttpInfo($destination, $origin, $avoid = null, $connections = null, $datasource = 'tranquility', $flag = 'shortest', $userAgent = null, $xUserAgent = null)
    {
        $returnType = 'int[]';
        $request = $this->getRouteOriginDestinationRequest($destination, $origin, $avoid, $connections, $datasource, $flag, $userAgent, $xUserAgent);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'int[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\nullx27\ESI\nullx27\ESI\Models\GetRouteOriginDestinationNotFound',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\nullx27\ESI\nullx27\ESI\Models\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getRouteOriginDestinationAsync
     *
     * Get route
     *
     * @param  int $destination destination solar system ID (required)
     * @param  int $origin origin solar system ID (required)
     * @param  int[] $avoid avoid solar system ID(s) (optional)
     * @param  int[][] $connections connected solar system pairs (optional)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $flag route security preference (optional, default to shortest)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getRouteOriginDestinationAsync($destination, $origin, $avoid = null, $connections = null, $datasource = 'tranquility', $flag = 'shortest', $userAgent = null, $xUserAgent = null)
    {
        return $this->getRouteOriginDestinationAsyncWithHttpInfo($destination, $origin, $avoid, $connections, $datasource, $flag, $userAgent, $xUserAgent)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getRouteOriginDestinationAsyncWithHttpInfo
     *
     * Get route
     *
     * @param  int $destination destination solar system ID (required)
     * @param  int $origin origin solar system ID (required)
     * @param  int[] $avoid avoid solar system ID(s) (optional)
     * @param  int[][] $connections connected solar system pairs (optional)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $flag route security preference (optional, default to shortest)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getRouteOriginDestinationAsyncWithHttpInfo($destination, $origin, $avoid = null, $connections = null, $datasource = 'tranquility', $flag = 'shortest', $userAgent = null, $xUserAgent = null)
    {
        $returnType = 'int[]';
        $request = $this->getRouteOriginDestinationRequest($destination, $origin, $avoid, $connections, $datasource, $flag, $userAgent, $xUserAgent);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getRouteOriginDestination'
     *
     * @param  int $destination destination solar system ID (required)
     * @param  int $origin origin solar system ID (required)
     * @param  int[] $avoid avoid solar system ID(s) (optional)
     * @param  int[][] $connections connected solar system pairs (optional)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $flag route security preference (optional, default to shortest)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getRouteOriginDestinationRequest($destination, $origin, $avoid = null, $connections = null, $datasource = 'tranquility', $flag = 'shortest', $userAgent = null, $xUserAgent = null)
    {
        // verify the required parameter 'destination' is set
        if ($destination === null) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $destination when calling getRouteOriginDestination'
            );
        }
        // verify the required parameter 'origin' is set
        if ($origin === null) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $origin when calling getRouteOriginDestination'
            );
        }
        if ($avoid !== null && count($avoid) > 100) {
            throw new \InvalidArgumentException('invalid value for "$avoid" when calling RoutesApi.getRouteOriginDestination, number of items must be less than or equal to 100.');
        }

        if ($connections !== null && count($connections) > 100) {
            throw new \InvalidArgumentException('invalid value for "$connections" when calling RoutesApi.getRouteOriginDestination, number of items must be less than or equal to 100.');
        }


        $resourcePath = '/route/{origin}/{destination}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if (is_array($avoid)) {
            $avoid = ObjectSerializer::serializeCollection($avoid, 'csv', true);
        }
        if ($avoid !== null) {
            $queryParams['avoid'] = ObjectSerializer::toQueryValue($avoid);
        }
        // query params
        if (is_array($connections)) {
            $connections = ObjectSerializer::serializeCollection($connections, 'csv', true);
        }
        if ($connections !== null) {
            $queryParams['connections'] = ObjectSerializer::toQueryValue($connections);
        }
        // query params
        if ($datasource !== null) {
            $queryParams['datasource'] = ObjectSerializer::toQueryValue($datasource);
        }
        // query params
        if ($flag !== null) {
            $queryParams['flag'] = ObjectSerializer::toQueryValue($flag);
        }
        // query params
        if ($userAgent !== null) {
            $queryParams['user_agent'] = ObjectSerializer::toQueryValue($userAgent);
        }
        // header params
        if ($xUserAgent !== null) {
            $headerParams['X-User-Agent'] = ObjectSerializer::toHeaderValue($xUserAgent);
        }

        // path params
        if ($destination !== null) {
            $resourcePath = str_replace(
                '{' . 'destination' . '}',
                ObjectSerializer::toPathValue($destination),
                $resourcePath
            );
        }
        // path params
        if ($origin !== null) {
            $resourcePath = str_replace(
                '{' . 'origin' . '}',
                ObjectSerializer::toPathValue($origin),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}