<?php

declare(strict_types=1);

namespace App\Entity;

class Movie
{
    /**
     * @var null|int
     */
    private $id;

    /**
     * @var null|string
     */
    private $title;

    /**
     * @var null|string
     */
    private $description;

    /**
     * @var null|string
     */
    private $director;

    /**
     * @var null|string
     */
    private $posterFilename;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Movie
     */
    public function setTitle(string $title): Movie
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Movie
     */
    public function setDescription(string $description): Movie
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDirector(): ?string
    {
        return $this->director;
    }

    /**
     * @param string $director
     * @return Movie
     */
    public function setDirector(string $director): Movie
    {
        $this->director = $director;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPosterFilename(): ?string
    {
        return $this->posterFilename;
    }

    /**
     * @param string|null $posterFilename
     * @return Movie
     */
    public function setPosterFilename(?string $posterFilename): Movie
    {
        $this->posterFilename = $posterFilename;
        return $this;
    }
}
