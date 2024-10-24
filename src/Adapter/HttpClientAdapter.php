<?php

declare(strict_types=1);

namespace App\Adapter;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpClientAdapter implements HttpClientAdapterInterface
{
    private HttpClientInterface $client;
    private LoggerInterface $logger;
    private string $apiKey;

    public function __construct(
        HttpClientInterface $httpClientApi,
        LoggerInterface $logger,
        string $apiKey,
    ) {
        $this->client = $httpClientApi;
        $this->logger = $logger;
        $this->apiKey = $apiKey;
    }

    public function get(string $uri, array $options = []): string
    {
        return $this->request('GET', $uri, $options);
    }

    public function request(string $method, string $uri, array $options = []): string
    {
        $options['query'] = array_merge(
            $options['query'] ?? [],
            ['api_key' => $this->apiKey]
        );

        try {
            $response = $this->client->request($method, $uri, $options);

            if ($response->getStatusCode() >= Response::HTTP_BAD_REQUEST) {
                $this->logger->alert($response->getContent());

                return '';
            }

            return $response->getContent();
        } catch (ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface $e) {
            $this->logger->alert($e->getResponse()?->getContent(false) ?? 'Error during request');
        } catch (TransportExceptionInterface $e) {
            $this->logger->alert("API request error: {$uri} - {$e->getMessage()}");
        }

        return '';
    }
}
