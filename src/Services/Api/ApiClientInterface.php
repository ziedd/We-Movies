<?php

declare(strict_types=1);

namespace App\Services\Api;

interface ApiClientInterface
{
    public function get(string $uri, array $options = []): string;
}
