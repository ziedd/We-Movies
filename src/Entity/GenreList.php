<?php

declare(strict_types=1);

namespace App\Entity;

class GenreList implements \IteratorAggregate
{
    /**
     * @var array<Genre>
     */
    private array $genres = [];

    /**
     * @return Genre[]
     */
    public function getGenres(): array
    {
        return $this->genres;
    }

    /**
     * @param Genre[] $genres
     */
    public function setGenres(array $genres): self
    {
        $this->genres = $genres;

        return $this;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->genres);
    }
}
