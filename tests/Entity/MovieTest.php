<?php

namespace App\Tests\Entity;

use App\Entity\Movie;
use PHPUnit\Framework\TestCase;

class MovieTest extends TestCase
{
    /**
     * @dataProvider getProperties
     */
    public function testAccessors(string $property, $value)
    {
        $entity = new Movie();

        $reflection = new \ReflectionProperty(Movie::class, $property);
        $reflection->setAccessible(true);
        $reflection->setValue($entity, $value);

        $getterMethod = \is_bool($value) ? sprintf('is%s', ucfirst($property)) : sprintf('get%s', ucfirst($property));
        static::assertSame($value, $entity->$getterMethod());

        $setterMethod = sprintf('set%s', ucfirst($property));
        $entity->$setterMethod($value);

        $this->assertEquals($value, $reflection->getValue($entity));
    }

    public function getProperties(): array
    {
        return [
            'id property' => ['id', 11],
            'posterPath property' => ['posterPath', '/path/action'],
            'adult property' => ['adult', false],
            'overview property' => ['overview', 'description here'],
            'releaseDate property' => ['releaseDate', 'first of december'],
            'genreIds property' => ['genreIds', [1, 2, 3]],
            'originalTitle property' => ['originalTitle', 'helloworld'],
            'originalLanguage property' => ['originalLanguage', 'fr'],
            'title property' => ['title', 'my title'],
            'backdropPath property' => ['backdropPath', null],
            'popularity property' => ['popularity', 2.5],
            'voteCount property' => ['voteCount', 999999],
            'video property' => ['video', true],
            'voteAverage property' => ['voteAverage', 8],
        ];
    }
}
