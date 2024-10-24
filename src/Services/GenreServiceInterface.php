<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\GenreList;

interface GenreServiceInterface
{
    public function getGenreList(): GenreList;
}
