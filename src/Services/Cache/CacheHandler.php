<?php

declare(strict_types=1);

namespace App\Services\Cache;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

final class CacheHandler implements CacheHandlerInterface
{
    private CacheItemPoolInterface $cacheItemPool;

    public function __construct(CacheItemPoolInterface $cacheItemPool)
    {
        $this->cacheItemPool = $cacheItemPool;
    }

    private function getCacheItem(?CacheOptions $cacheConfig): ?CacheItemInterface
    {
        if (null === $cacheConfig) {
            return null;
        }

        return $this->cacheItemPool->getItem($cacheConfig->key);
    }

    public function fetch(?CacheOptions $cacheConfig)
    {
        $cacheItem = $this->getCacheItem($cacheConfig);

        return (null !== $cacheItem && $cacheItem->isHit()) ? $cacheItem->get() : null;
    }

    public function persist(?CacheOptions $cacheConfig, $data): void
    {
        $cacheItem = $this->getCacheItem($cacheConfig);

        if (null !== $cacheItem) {
            $cacheItem->set($data);
            $cacheItem->expiresAfter($cacheConfig->ttl);
            $this->cacheItemPool->save($cacheItem);
        }
    }
}
