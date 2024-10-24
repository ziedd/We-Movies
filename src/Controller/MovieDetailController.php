<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\MovieServiceInterface;
use App\Services\VideoServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie/{movieId<\d+>}', name: 'movie_view')]
class MovieDetailController extends AbstractController
{
    public function __invoke(
        MovieServiceInterface $movieService,
        VideoServiceInterface $videoService,
        int $movieId,
    ): Response {
        $movie = $movieService->getById($movieId);
        $video = $videoService->getVideoList($movieId)->first();

        return $this->render('movie/view.html.twig', [
            'movie' => $movie,
            'video' => $video,
        ]);
    }
}
