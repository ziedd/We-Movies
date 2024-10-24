<?php

namespace App\Tests\Entity;

use App\Entity\Genre;
use PHPUnit\Framework\TestCase;

class GenreTest extends TestCase
{
    /**
     * @dataProvider getProperties
     */
    public function testAccessors(string $property, $value)
    {
        $entity = new Genre();

        $reflection = new \ReflectionProperty(Genre::class, $property);
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
            'name property' => ['name', 'action'],
        ];
    }
}
