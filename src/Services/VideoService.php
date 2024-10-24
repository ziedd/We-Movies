<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\VideoList;

final class VideoService extends AbstractApiService implements VideoServiceInterface
{
    public function getVideoList(int $movieId): VideoList
    {
        try {
            $data = $this->apiClient->get("movie/$movieId/videos");

            return $this->serializer->deserialize($data, VideoList::class, 'json');
        } catch (\Exception $e) {
            return new VideoList();
        }
    }
}
