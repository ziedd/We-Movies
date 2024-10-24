<?php

declare(strict_types=1);

namespace App\Entity;

class MovieList implements \IteratorAggregate
{
    private int $page;

    /**
     * @var array<Movie>
     */
    private array $results = [];

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return Movie[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param Movie[] $results
     */
    public function setResults(array $results): self
    {
        $this->results = $results;

        return $this;
    }

    public function first(): ?Movie
    {
        return $this->results[0] ?? null;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->results);
    }
}
