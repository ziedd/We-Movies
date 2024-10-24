<?php

namespace App\Tests\Entity;

use App\Entity\ImageConfig;
use PHPUnit\Framework\TestCase;

class ImageConfigTest extends TestCase
{
    /**
     * @dataProvider getProperties
     */
    public function testAccessors(string $property, $value)
    {
        $entity = new ImageConfig();

        $reflection = new \ReflectionProperty(ImageConfig::class, $property);
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
            'images property' => ['images', []],
        ];
    }

    public function testGetSecureBaseUrl()
    {
        $imageConfig = new ImageConfig();
        $reflection = new \ReflectionProperty(ImageConfig::class, 'images');
        $reflection->setAccessible(true);
        $reflection->setValue($imageConfig, ['secure_base_url' => 'http://imagehost.com']);

        static::assertSame('http://imagehost.com', $imageConfig->getSecureBaseUrl());
    }
}
