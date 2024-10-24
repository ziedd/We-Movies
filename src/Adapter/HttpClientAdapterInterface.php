<?php

declare(strict_types=1);

namespace App\Adapter;

interface HttpClientAdapterInterface
{
    public function get(string $uri, array $options = []): string;

    public function request(string $method, string $uri, array $options = []): string;
}
