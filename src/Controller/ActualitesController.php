<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Actualites;

class ActualitesController extends AbstractController
{
    /**
     * @Route("/actualites", name="actualites")
     */
    public function index(): Response
    {
        $user = $this->getUser();

        $actus = $this->getDoctrine()->getRepository(Actualites::class)->findBy([], ['id' => 'DESC']);

        return $this->render('actualites/index.html.twig', [
            'user' => $user,
            'actus' => $actus
        ]);
    }
}
