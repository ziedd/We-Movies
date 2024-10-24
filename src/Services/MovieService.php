<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Movie;
use App\Entity\MovieList;

final class MovieService extends AbstractApiService implements MovieServiceInterface
{
    public function getMovieList($filters = []): MovieList
    {
        $options = [];

        if (!empty($filters)) {
            $options['query'] = $filters;
        }

        return $this->fetchMovieList('discover/movie', $options);
    }

    public function getPopularMovies(): MovieList
    {
        return $this->fetchMovieList('movie/popular');
    }

    public function getById(int $movieId): ?Movie
    {
        try {
            $data = $this->apiClient->get("movie/$movieId");

            return $this->serializer->deserialize($data, Movie::class, 'json');
        } catch (\Exception $e) {
            return null;
        }
    }

    public function search(string $term): MovieList
    {
        $options = ['query' => ['query' => $term]];

        return $this->fetchMovieList('search/movie', $options);
    }

    private function fetchMovieList(string $uri, array $options = []): MovieList
    {
        try {
            $data = $this->apiClient->get($uri, $options);

            return $this->serializer->deserialize($data, MovieList::class, 'json');
        } catch (\Exception $e) {
            return new MovieList();
        }
    }
}
