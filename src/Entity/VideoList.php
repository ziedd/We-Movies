<?php

declare(strict_types=1);

namespace App\Entity;

class VideoList implements \IteratorAggregate
{
    private int $id;

    /**
     * @var array<Video>
     */
    private array $results = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Video[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param Video[] $results
     */
    public function setResults(array $results): self
    {
        $this->results = $results;

        return $this;
    }

    public function first(): ?Video
    {
        return $this->results[0] ?? null;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->results);
    }
}
