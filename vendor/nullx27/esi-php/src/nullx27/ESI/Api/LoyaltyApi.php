<?php
/**
 * LoyaltyApi
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
 * LoyaltyApi Class Doc Comment
 *
 * @category Class
 * @package  nullx27\ESI
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class LoyaltyApi
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
     * Operation getCharactersCharacterIdLoyaltyPoints
     *
     * Get loyalty points
     *
     * @param  int $characterId An EVE character ID (required)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $token Access token to use if unable to set a header (optional)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \nullx27\ESI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \nullx27\ESI\nullx27\ESI\Models\GetCharactersCharacterIdLoyaltyPoints200Ok[]
     */
    public function getCharactersCharacterIdLoyaltyPoints($characterId, $datasource = 'tranquility', $token = null, $userAgent = null, $xUserAgent = null)
    {
        list($response) = $this->getCharactersCharacterIdLoyaltyPointsWithHttpInfo($characterId, $datasource, $token, $userAgent, $xUserAgent);
        return $response;
    }

    /**
     * Operation getCharactersCharacterIdLoyaltyPointsWithHttpInfo
     *
     * Get loyalty points
     *
     * @param  int $characterId An EVE character ID (required)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $token Access token to use if unable to set a header (optional)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \nullx27\ESI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \nullx27\ESI\nullx27\ESI\Models\GetCharactersCharacterIdLoyaltyPoints200Ok[], HTTP status code, HTTP response headers (array of strings)
     */
    public function getCharactersCharacterIdLoyaltyPointsWithHttpInfo($characterId, $datasource = 'tranquility', $token = null, $userAgent = null, $xUserAgent = null)
    {
        $returnType = '\nullx27\ESI\nullx27\ESI\Models\GetCharactersCharacterIdLoyaltyPoints200Ok[]';
        $request = $this->getCharactersCharacterIdLoyaltyPointsRequest($characterId, $datasource, $token, $userAgent, $xUserAgent);

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
                        '\nullx27\ESI\nullx27\ESI\Models\GetCharactersCharacterIdLoyaltyPoints200Ok[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\nullx27\ESI\nullx27\ESI\Models\Forbidden',
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
     * Operation getCharactersCharacterIdLoyaltyPointsAsync
     *
     * Get loyalty points
     *
     * @param  int $characterId An EVE character ID (required)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $token Access token to use if unable to set a header (optional)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getCharactersCharacterIdLoyaltyPointsAsync($characterId, $datasource = 'tranquility', $token = null, $userAgent = null, $xUserAgent = null)
    {
        return $this->getCharactersCharacterIdLoyaltyPointsAsyncWithHttpInfo($characterId, $datasource, $token, $userAgent, $xUserAgent)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getCharactersCharacterIdLoyaltyPointsAsyncWithHttpInfo
     *
     * Get loyalty points
     *
     * @param  int $characterId An EVE character ID (required)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $token Access token to use if unable to set a header (optional)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getCharactersCharacterIdLoyaltyPointsAsyncWithHttpInfo($characterId, $datasource = 'tranquility', $token = null, $userAgent = null, $xUserAgent = null)
    {
        $returnType = '\nullx27\ESI\nullx27\ESI\Models\GetCharactersCharacterIdLoyaltyPoints200Ok[]';
        $request = $this->getCharactersCharacterIdLoyaltyPointsRequest($characterId, $datasource, $token, $userAgent, $xUserAgent);

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
     * Create request for operation 'getCharactersCharacterIdLoyaltyPoints'
     *
     * @param  int $characterId An EVE character ID (required)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $token Access token to use if unable to set a header (optional)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getCharactersCharacterIdLoyaltyPointsRequest($characterId, $datasource = 'tranquility', $token = null, $userAgent = null, $xUserAgent = null)
    {
        // verify the required parameter 'characterId' is set
        if ($characterId === null) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $characterId when calling getCharactersCharacterIdLoyaltyPoints'
            );
        }
        if ($characterId < 1) {
            throw new \InvalidArgumentException('invalid value for "$characterId" when calling LoyaltyApi.getCharactersCharacterIdLoyaltyPoints, must be bigger than or equal to 1.');
        }


        $resourcePath = '/characters/{character_id}/loyalty/points/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($datasource !== null) {
            $queryParams['datasource'] = ObjectSerializer::toQueryValue($datasource);
        }
        // query params
        if ($token !== null) {
            $queryParams['token'] = ObjectSerializer::toQueryValue($token);
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
        if ($characterId !== null) {
            $resourcePath = str_replace(
                '{' . 'character_id' . '}',
                ObjectSerializer::toPathValue($characterId),
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

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
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
     * Operation getLoyaltyStoresCorporationIdOffers
     *
     * List loyalty store offers
     *
     * @param  int $corporationId An EVE corporation ID (required)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \nullx27\ESI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \nullx27\ESI\nullx27\ESI\Models\GetLoyaltyStoresCorporationIdOffers200Ok[]
     */
    public function getLoyaltyStoresCorporationIdOffers($corporationId, $datasource = 'tranquility', $userAgent = null, $xUserAgent = null)
    {
        list($response) = $this->getLoyaltyStoresCorporationIdOffersWithHttpInfo($corporationId, $datasource, $userAgent, $xUserAgent);
        return $response;
    }

    /**
     * Operation getLoyaltyStoresCorporationIdOffersWithHttpInfo
     *
     * List loyalty store offers
     *
     * @param  int $corporationId An EVE corporation ID (required)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \nullx27\ESI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \nullx27\ESI\nullx27\ESI\Models\GetLoyaltyStoresCorporationIdOffers200Ok[], HTTP status code, HTTP response headers (array of strings)
     */
    public function getLoyaltyStoresCorporationIdOffersWithHttpInfo($corporationId, $datasource = 'tranquility', $userAgent = null, $xUserAgent = null)
    {
        $returnType = '\nullx27\ESI\nullx27\ESI\Models\GetLoyaltyStoresCorporationIdOffers200Ok[]';
        $request = $this->getLoyaltyStoresCorporationIdOffersRequest($corporationId, $datasource, $userAgent, $xUserAgent);

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
                        '\nullx27\ESI\nullx27\ESI\Models\GetLoyaltyStoresCorporationIdOffers200Ok[]',
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
     * Operation getLoyaltyStoresCorporationIdOffersAsync
     *
     * List loyalty store offers
     *
     * @param  int $corporationId An EVE corporation ID (required)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLoyaltyStoresCorporationIdOffersAsync($corporationId, $datasource = 'tranquility', $userAgent = null, $xUserAgent = null)
    {
        return $this->getLoyaltyStoresCorporationIdOffersAsyncWithHttpInfo($corporationId, $datasource, $userAgent, $xUserAgent)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLoyaltyStoresCorporationIdOffersAsyncWithHttpInfo
     *
     * List loyalty store offers
     *
     * @param  int $corporationId An EVE corporation ID (required)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLoyaltyStoresCorporationIdOffersAsyncWithHttpInfo($corporationId, $datasource = 'tranquility', $userAgent = null, $xUserAgent = null)
    {
        $returnType = '\nullx27\ESI\nullx27\ESI\Models\GetLoyaltyStoresCorporationIdOffers200Ok[]';
        $request = $this->getLoyaltyStoresCorporationIdOffersRequest($corporationId, $datasource, $userAgent, $xUserAgent);

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
     * Create request for operation 'getLoyaltyStoresCorporationIdOffers'
     *
     * @param  int $corporationId An EVE corporation ID (required)
     * @param  string $datasource The server name you would like data from (optional, default to tranquility)
     * @param  string $userAgent Client identifier, takes precedence over headers (optional)
     * @param  string $xUserAgent Client identifier, takes precedence over User-Agent (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getLoyaltyStoresCorporationIdOffersRequest($corporationId, $datasource = 'tranquility', $userAgent = null, $xUserAgent = null)
    {
        // verify the required parameter 'corporationId' is set
        if ($corporationId === null) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $corporationId when calling getLoyaltyStoresCorporationIdOffers'
            );
        }
        if ($corporationId < 1) {
            throw new \InvalidArgumentException('invalid value for "$corporationId" when calling LoyaltyApi.getLoyaltyStoresCorporationIdOffers, must be bigger than or equal to 1.');
        }


        $resourcePath = '/loyalty/stores/{corporation_id}/offers/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($datasource !== null) {
            $queryParams['datasource'] = ObjectSerializer::toQueryValue($datasource);
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
        if ($corporationId !== null) {
            $resourcePath = str_replace(
                '{' . 'corporation_id' . '}',
                ObjectSerializer::toPathValue($corporationId),
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
