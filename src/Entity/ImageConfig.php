<?php

declare(strict_types=1);

namespace App\Entity;

class ImageConfig
{
    private array $images = [];

    public function getImages(): array
    {
        return $this->images;
    }

    public function setImages(array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getSecureBaseUrl(): string
    {
        return $this->images['secure_base_url'] ?? '';
    }
}
