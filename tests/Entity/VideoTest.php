<?php

namespace App\Tests\Entity;

use App\Entity\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    /**
     * @dataProvider getProperties
     */
    public function testAccessors(string $property, $value)
    {
        $entity = new Video();

        $reflection = new \ReflectionProperty(Video::class, $property);
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
            'name property' => ['name', 'the name'],
            'key property' => ['key', 'toto'],
            'site property' => ['site', 'description here'],
            'size property' => ['size', 100],
            'type property' => ['type', 'short film'],
            'official property' => ['official', false],
            'publishedAt property' => ['publishedAt', 'july 1987'],
        ];
    }
}
