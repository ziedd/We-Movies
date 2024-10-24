<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\GenreServiceInterface;
use App\Services\MovieServiceInterface;
use App\Services\VideoServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/', name: 'mainpage')]
class MainPageController extends AbstractController
{
    public function __invoke(
        GenreServiceInterface $genreService,
        MovieServiceInterface $movieService,
        VideoServiceInterface $videoService,
    ): Response {
        $genreList = $genreService->getGenreList();
        $popularMovies = $movieService->getPopularMovies();
        $leadMovie = $popularMovies->first();
        $mainVideo = $videoService->getVideoList($leadMovie?->getId())->first();

        return $this->render('mainpage.html.twig', [
            'movies' => $popularMovies,
            'genre_list' => $genreList,
            'lead_movie' => $leadMovie,
            'main_video' => $mainVideo,
        ]);
    }
}
