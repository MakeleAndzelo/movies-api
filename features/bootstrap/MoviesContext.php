<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Doctrine\ORM\EntityManagerInterface;

class MoviesContext extends MinkContext implements Context
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Given I am on the movie create page
     */
    public function iAmOnTheMovieCreatePage(): void
    {
        $this->visitPath('/admin/movies/create');
    }

    /**
     * @When I type title as :title, director as :director and description as :description
     *
     * @param string $title
     * @param string $director
     * @param string $description
     */
    public function iTypeTitleAsDirectorAsAndDescriptionAs(string $title, string $director, string $description): void
    {
        $this->fillField('movie[title]', $title);
        $this->fillField('movie[director]', $director);
        $this->fillField('movie[description]', $description);
    }

    /**
     * @Given I attach a sample poster
     */
    public function iAttachASamplePoster()
    {
        $this->attachFileToField('movie[poster]', 'images.poster.jpg');
    }

}
