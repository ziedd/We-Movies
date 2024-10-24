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
    public function __construct(
        private HttpClientInterface $httpClientApi,
        private LoggerInterface $logger,
    ) {
        $this->client = $httpClientApi;
    }

    public function get(string $uri, array $options = []): string
    {
        return $this->request('GET', $uri, $options);
    }

    public function request(string $method, string $uri, array $options = []): string
    {
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
