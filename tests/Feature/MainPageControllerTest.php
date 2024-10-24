<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

it('renders the main page successfully', function () {
    $client = static::createClient();
    $client->request('GET', '/');

    expect($client->getResponse()->isSuccessful())->toBeTrue();
});

it('displays the genre list and popular movies', function () {
    $client = static::createClient();
    $crawler = $client->request('GET', '/');

    expect($crawler->filter('.genre-list')->count())->toBeGreaterThan(0);

    expect($crawler->filter('.popular-movies')->count())->toBeGreaterThan(0);
});
