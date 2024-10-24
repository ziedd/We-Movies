<?php

use App\Services\MovieServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

it('renders the movie index page successfully', function () {
    $client = static::createClient();
    $client->request('GET', '/movie');

    expect($client->getResponse()->isSuccessful())->toBeTrue();
});

it('filters movies by genres', function () {
    $movieServiceMock = $this->createMock(MovieServiceInterface::class);
    $movieServiceMock->method('getMovieList')->willReturn([
        ['title' => 'Movie 1', 'genre_ids' => [1, 2]],
        ['title' => 'Movie 2', 'genre_ids' => [2, 3]],
    ]);

    $client = static::createClient();

    $client->getContainer()->set(MovieServiceInterface::class, $movieServiceMock);

    $client->request('GET', '/movie', ['genreids' => '2']);

    $responseContent = $client->getResponse()->getContent();

    expect($client->getResponse()->isSuccessful())->toBeTrue();
    expect($responseContent)->toContain('Movie 1');
    expect($responseContent)->toContain('Movie 2');
});
