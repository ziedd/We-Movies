<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Services\MovieServiceInterface;
use App\Services\VideoServiceInterface;
use Symfony\Component\HttpFoundation\Response;

beforeEach(function () {
    $this->client = static::createClient();

    $this->mockMovieService = $this->createMock(MovieServiceInterface::class);
    $this->mockVideoService = $this->createMock(VideoServiceInterface::class);

    $this->client->getContainer()->set(MovieServiceInterface::class, $this->mockMovieService);
    $this->client->getContainer()->set(VideoServiceInterface::class, $this->mockVideoService);
});

test('movie detail controller renders correctly', function () {
    $movieId = 1;
    $expectedMovie = (object)[
        'id' => $movieId,
        'title' => 'Inception',
        'description' => 'A mind-bending thriller by Christopher Nolan.',
    ];

    $expectedVideo = (object)[
        'id' => 101,
        'url' => 'https://video.url/trailer',
    ];

    $this->mockMovieService
        ->method('getById')
        ->with($movieId)
        ->willReturn($expectedMovie);

    $this->mockVideoService
        ->method('getVideoList')
        ->with($movieId)
        ->willReturn(new \ArrayObject([$expectedVideo]));

    $this->client->request('GET', "/movie/$movieId");

    $response = $this->client->getResponse();

    expect($response->getStatusCode())->toBe(Response::HTTP_OK);

    $crawler = $this->client->getCrawler();

    $movieTitle = $crawler->filter('h1.movie-title')->text();
    expect($movieTitle)->toBe('Inception');

    $movieDescription = $crawler->filter('p.movie-description')->text();
    expect($movieDescription)->toBe('A mind-bending thriller by Christopher Nolan.');

    $videoUrl = $crawler->filter('video#movie-trailer')->attr('src');
    expect($videoUrl)->toBe('https://video.url/trailer');
});
