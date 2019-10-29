<?php

use App\Entity\Movie;
use Behat\Behat\Context\Context;
use Behatch\Context\RestContext;
use Behatch\HttpCall\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;

class FeatureContext extends RestContext implements Context
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(Request $request, EntityManagerInterface $entityManager)
    {
        parent::__construct($request);
        $this->entityManager = $entityManager;
    }

    /**
     * @Given There is a movie with a title :title
     *
     * @param string $title
     * @throws Exception
     */
    public function thereIsAMovieWithATitle(string $title): void
    {
        $movie = new Movie($title, 'Testing description', 'Testing director');
        $this->entityManager->persist($movie);
        $this->entityManager->flush();
    }

    /**
     * @BeforeScenario @createSchema
     *
     * @throws ToolsException
     */
    public function createSchema(): void
    {
        $classes = $this->entityManager->getMetadataFactory()->getAllMetadata();

        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->dropSchema($classes);
        $schemaTool->createSchema($classes);
    }
}
