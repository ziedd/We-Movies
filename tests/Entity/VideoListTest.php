<?php

namespace App\Tests\Entity;

use App\Entity\VideoList;
use PHPUnit\Framework\TestCase;

class VideoListTest extends TestCase
{
    /**
     * @dataProvider getProperties
     */
    public function testAccessors(string $property, $value)
    {
        $entity = new VideoList();

        $reflection = new \ReflectionProperty(VideoList::class, $property);
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
            'id property' => ['id', 123456],
            'results property' => ['results', []],
        ];
    }

    public function testGetIterator()
    {
        $videoList = new VideoList();

        static::assertEquals(new \ArrayIterator([]), $videoList->getIterator());
    }
}
