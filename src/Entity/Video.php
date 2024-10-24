<?php

declare(strict_types=1);

namespace App\Entity;

class Video
{
    private int $id;
    private string $name;
    private string $key;
    private string $site;
    private int $size;
    private string $type;
    private bool $official;
    private \DateTimeInterface $publishedAt;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Video
    {
        $this->name = $name;

        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): Video
    {
        $this->key = $key;

        return $this;
    }

    public function getSite(): string
    {
        return $this->site;
    }

    public function setSite(string $site): Video
    {
        $this->site = $site;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): Video
    {
        $this->size = $size;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): Video
    {
        $this->type = $type;

        return $this;
    }

    public function isOfficial(): bool
    {
        return $this->official;
    }

    public function setOfficial(bool $official): Video
    {
        $this->official = $official;

        return $this;
    }

    public function getPublishedAt(): \DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(string $publishedAt): Video
    {
        return $this;
    }
}
