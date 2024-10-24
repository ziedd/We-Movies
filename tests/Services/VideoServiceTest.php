<?php

namespace App\Tests\Services;

use App\Entity\VideoList;
use App\Services\Api\ApiClientInterface;
use App\Services\Cache\CacheHandlerInterface;
use App\Services\VideoService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;

class VideoServiceTest extends TestCase
{
    public function testGetVideoList()
    {
        $apiClient = $this->createMock(ApiClientInterface::class);
        $serializer = $this->createMock(SerializerInterface::class);
        $cacheHandler = $this->createMock(CacheHandlerInterface::class);

        $videoList = new VideoList();
        $videoList->setId(1);

        $apiClient->expects(static::once())
            ->method('get')
            ->with('movie/17,25,46/videos')
            ->willReturn('{json_reponse}');

        $serializer->expects(static::once())
            ->method('deserialize')
            ->willReturn($videoList);

        $videoService = new VideoService(
            $apiClient,
            $serializer,
            $cacheHandler
        );

        $result = $videoService->getVideoList('17,25,46');
        static::assertSame($videoList, $result);
    }
}
