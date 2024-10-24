<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\MovieServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ExploreMoviesController extends AbstractController
{
    #[Route('/movie', name: 'movie_index', methods: ['GET'])]
    public function __invoke(Request $request, MovieServiceInterface $movieService): Response
    {
        $genreIds = $request->query->get('genreids', '');
        $filters = [
            'with_genres' => $genreIds,
        ];

        $movies = $movieService->getMovieList($filters);

        return $this->render('movie/index.html.twig', [
            'movies' => $movies,
        ]);
    }
}
