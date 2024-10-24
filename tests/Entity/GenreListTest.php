<?php

namespace App\Tests\Entity;

use App\Entity\GenreList;
use PHPUnit\Framework\TestCase;

class GenreListTest extends TestCase
{
    /**
     * @dataProvider getProperties
     */
    public function testAccessors(string $property, $value)
    {
        $entity = new GenreList();

        $reflection = new \ReflectionProperty(GenreList::class, $property);
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
        $genreList = new GenreList();

        static::assertEquals(new \ArrayIterator([]), $genreList->getIterator());
    }
}
