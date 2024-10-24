<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Adapter\HttpClientAdapter;

class ApiClient implements ApiClientInterface
{
    public function __construct(private HttpClientAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function get(string $uri, array $options = []): string
    {
        return $this->adapter->get($uri, $options);
    }
}
