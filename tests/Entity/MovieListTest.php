<?php

namespace App\Tests\Entity;

use App\Entity\MovieList;
use PHPUnit\Framework\TestCase;

class MovieListTest extends TestCase
{
    /**
     * @dataProvider getProperties
     */
    public function testAccessors(string $property, $value)
    {
        $entity = new MovieList();

        $reflection = new \ReflectionProperty(MovieList::class, $property);
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
            'genres property' => ['genres', []],
        ];
    }

    public function testGetIterator()
    {
        $movieList = new MovieList();

        static::assertEquals(new \ArrayIterator([]), $movieList->getIterator());
    }
}
