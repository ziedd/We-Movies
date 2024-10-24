<?php

declare(strict_types=1);

namespace App\Services\Cache;

interface CacheHandlerInterface
{
    public function fetch(?CacheOptions $cacheConfig);

    public function persist(?CacheOptions $cacheConfig, $data): void;
}
