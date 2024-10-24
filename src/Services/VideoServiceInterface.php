<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\VideoList;

interface VideoServiceInterface
{
    public function getVideoList(int $movieId): VideoList;
}
