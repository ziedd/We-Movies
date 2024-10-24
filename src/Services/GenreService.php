<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\GenreList;
use App\Services\Cache\CacheOptions;

final class GenreService extends AbstractApiService implements GenreServiceInterface
{
    public function getGenreList(): GenreList
    {
        $cacheOptions = new CacheOptions('genres', 46300);
        $data = $this->cacheHandler->fetch($cacheOptions);

        if ($data) {
            return $this->serializer->deserialize($data, GenreList::class, 'json');
        }

        $data = $this->apiClient->get('genre/movie/list');
        $this->cacheHandler->persist($cacheOptions, $data);

        return $this->serializer->deserialize($data, GenreList::class, 'json');
    }
}
