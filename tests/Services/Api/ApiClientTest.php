<?php

namespace App\Tests\Services\Api;

use App\Adapter\HttpClientAdapterInterface;
use App\Services\Api\ApiClient;
use App\Services\Api\ApiClientInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ApiClientTest extends TestCase
{
    public function testGet()
    {
        $httpClient = $this->createMock(ApiClientInterface::class);
        $httpClientAdapter = $this->createMock(HttpClientAdapterInterface::class);
        $logger = $this->createMock(LoggerInterface::class);

        $response = $this->createMock(ResponseInterface::class);
        $response->expects(static::once())
            ->method('getStatusCode')
            ->willReturn(200);

        $response->expects(static::once())
            ->method('getContent')
            ->willReturn('{json_response}');

        $httpClient->expects(static::once())
            ->method('request')
            ->willReturn($response);

        $apiClient = new ApiClient(
            $httpClientAdapter,
            $logger,
            'api_secret_key'
        );

        $apiClient->get('api/uri');
    }

    public function testGetWithStatusCodeKo()
    {
        $httpClient = $this->createMock(ApiClientInterface::class);
        $httpClientAdapter = $this->createMock(HttpClientAdapterInterface::class);
        $logger = $this->createMock(LoggerInterface::class);

        $response = $this->createMock(ResponseInterface::class);
        $response->expects(static::once())
            ->method('getStatusCode')
            ->willReturn(404);

        $logger->expects(static::once())
            ->method('alert');

        $response->expects(static::once())
            ->method('getContent')
            ->willReturn('{error}');

        $httpClient->expects(static::once())
            ->method('request')
            ->willReturn($response);

        $apiClient = new ApiClient(
            $httpClientAdapter,
            $logger,
            'api_secret_key'
        );

        $data = $apiClient->get('api/uri');
        static::assertEmpty($data);
    }
}
