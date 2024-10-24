<?php

declare(strict_types=1);

namespace App\Entity;

class Movie
{
    private int $id;
    private ?string $posterPath;
    private bool $adult;
    private string $overview;
    private string $releaseDate;
    private array $genreIds;
    private string $originalTitle;
    private string $originalLanguage;
    private string $title;
    private ?string $backdropPath;
    private float $popularity;
    private int $voteCount;
    private bool $video;
    private int $voteAverage;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getPosterPath(): ?string
    {
        return $this->posterPath;
    }

    public function setPosterPath(?string $posterPath): self
    {
        $this->posterPath = $posterPath;

        return $this;
    }

    public function isAdult(): bool
    {
        return $this->adult;
    }

    public function setAdult(bool $adult): self
    {
        $this->adult = $adult;

        return $this;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): self
    {
        $this->overview = $overview;

        return $this;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(string $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getGenreIds(): array
    {
        return $this->genreIds;
    }

    public function setGenreIds(array $genreIds): self
    {
        $this->genreIds = $genreIds;

        return $this;
    }

    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(string $originalTitle): self
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }

    public function setOriginalLanguage(string $originalLanguage): self
    {
        $this->originalLanguage = $originalLanguage;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBackdropPath(): ?string
    {
        return $this->backdropPath;
    }

    public function setBackdropPath(?string $backdropPath): self
    {
        $this->backdropPath = $backdropPath;

        return $this;
    }

    public function getPopularity(): float
    {
        return $this->popularity;
    }

    public function setPopularity(float $popularity): self
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function getVoteCount(): int
    {
        return $this->voteCount;
    }

    public function setVoteCount(int $voteCount): self
    {
        $this->voteCount = $voteCount;

        return $this;
    }

    public function isVideo(): bool
    {
        return $this->video;
    }

    public function setVideo(bool $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getVoteAverage(): int
    {
        return $this->voteAverage;
    }

    public function setVoteAverage(int $voteAverage): self
    {
        $this->voteAverage = $voteAverage;

        return $this;
    }
}
