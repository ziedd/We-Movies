<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\ImageConfig;
use App\Services\Cache\CacheOptions;

final class ImageConfigService extends AbstractApiService implements ImageConfigServiceInterface
{
    public function getImageHost(): string
    {
        // 86400 = 24h
        $cacheOptions = new CacheOptions('configuration', 86400);
        $data = $this->cacheHandler->fetch($cacheOptions);

        if (null != $data) {
            /** @var ImageConfig $configuration */
            $configuration = $this->serializer->deserialize($data, ImageConfig::class, 'json');

            return $configuration->getSecureBaseUrl();
        }

        $data = $this->apiClient->get('configuration');

        $this->cacheHandler->persist($cacheOptions, $data);

        /** @var ImageConfig $configuration */
        $configuration = $this->serializer->deserialize($data, ImageConfig::class, 'json');

        return $configuration->getSecureBaseUrl();
    }
}
