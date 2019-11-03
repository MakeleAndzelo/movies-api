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

    /**
     * @var Movie
     */
    private $movie;

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
        $this->movie = (new Movie)
            ->setTitle($title)
            ->setDescription('Testing description')
            ->setDirector('Testing director');
        $this->entityManager->persist($this->movie);
        $this->entityManager->flush();
    }


    /**
     * @When I send a request for that movie
     */
    public function iSendARequestForThatMovie()
    {
        $this->request->setHttpHeader('Content-Type', 'application/ld+json');
        $this->request->setHttpHeader('Accept', 'application/ld+json');
        return $this->request->send(
            'GET',
            $this->locatePath(sprintf('/api/movies/%s', $this->movie->getId())),
            [],
            [],
            null
        );
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
