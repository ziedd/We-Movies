<?php

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Services\MovieServiceInterface;
use Symfony\Component\HttpFoundation\Response;

beforeEach(function () {
    $this->client = static::createClient();
    $this->mockMovieService = $this->createMock(MovieServiceInterface::class);
    $this->client->getContainer()->set(MovieServiceInterface::class, $this->mockMovieService);
});

test('autocomplete controller returns expected JSON response', function () {
    $expectedMovies = [
        ['title' => 'Inception'],
        ['title' => 'Interstellar'],
    ];

    $this->mockMovieService
        ->method('search')
        ->willReturn($expectedMovies);

    $this->client->request('GET', '/movie/autocomplete', ['term' => 'In']);

    $response = $this->client->getResponse();
    $responseData = json_decode($response->getContent(), true);

    expect($response->getStatusCode())->toBe(Response::HTTP_OK);
    expect($responseData)->toBe($expectedMovies);
});
