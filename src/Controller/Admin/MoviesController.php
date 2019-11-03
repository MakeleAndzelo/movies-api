<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Movie;
use App\Form\Type\MovieType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/movies")
 */
final class MoviesController extends AbstractController
{
    /**
     * @Route("", name="movies_list")
     *
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $moviesRepository = $entityManager->getRepository(Movie::class);

        return $this->render('admin/movies/index.html.twig', [
            'movies' => $moviesRepository->findAll()
        ]);
    }

    /**
     * @Route("/create", methods={"GET", "POST"}, name="movies_create")
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function create(
        Request $request,
        EntityManagerInterface $entityManager,
        FileUploader $fileUploader
    ): Response {
        $form = $this->createForm(MovieType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $movie = $form->getData();

            $posterFile = $form['poster']->getData();

            if ($posterFile) {
                $posterFile = $fileUploader->upload($posterFile);
                $movie->setPosterFilename($posterFile);
            }

            $entityManager->persist($movie);
            $entityManager->flush();

            return $this->redirectToRoute('movies_list');
        }

        return $this->render('admin/movies/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
