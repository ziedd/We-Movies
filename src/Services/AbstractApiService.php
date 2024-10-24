<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Api\ApiClientInterface;
use App\Services\Cache\CacheHandlerInterface;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractApiService
{
    protected ApiClientInterface $apiClient;
    protected SerializerInterface $serializer;
    protected CacheHandlerInterface $cacheHandler;

    public function __construct(
        ApiClientInterface $apiClient,
        SerializerInterface $serializer,
        CacheHandlerInterface $cacheHandler,
    ) {
        $this->apiClient = $apiClient;
        $this->serializer = $serializer;
        $this->cacheHandler = $cacheHandler;
    }
}
