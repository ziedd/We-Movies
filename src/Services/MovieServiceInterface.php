<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Movie;
use App\Entity\MovieList;

interface MovieServiceInterface
{
    public function getMovieList($filters = []): MovieList;

    public function getPopularMovies(): MovieList;

    public function getById(int $movieId): ?Movie;

    public function search(string $term): MovieList;
}
