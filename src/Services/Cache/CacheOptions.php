<?php

declare(strict_types=1);

namespace App\Services\Cache;

final class CacheOptions
{
    public string $key;
    public int $ttl;

    public function __construct(string $key, int $ttl)
    {
        $this->key = $key;
        $this->ttl = $ttl;
    }
}
