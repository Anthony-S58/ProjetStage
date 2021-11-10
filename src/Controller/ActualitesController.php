<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Actualites;
use App\Entity\Chocolaterie;


class ActualitesController extends AbstractController
{
    /**
     * @Route("/actualites", name="actualites")
     */
    public function index(): Response
    {
        $user = $this->getUser();

        $actus = $this->getDoctrine()->getRepository(Actualites::class)->findBy([], ['id' => 'DESC']);
        $chocolateries = $this->getDoctrine()->getRepository(Chocolaterie::class)->findBy([], ['ville' => 'ASC']);


        return $this->render('actualites/index.html.twig', [
            'user' => $user,
            'actus' => $actus,
            'chocolateries' => $chocolateries

        ]);
    }

    /**
     * @Route("/actualites/{id}", name="actu")
     */
    public function actu($id): Response
    {
        $user = $this->getUser();

        $actus = $this->getDoctrine()->getRepository(Actualites::class)->findBy(['chocolaterie' => $id], ['id' => 'DESC']);
        $chocolateries = $this->getDoctrine()->getRepository(Chocolaterie::class)->findBy([], ['ville' => 'ASC']);


        return $this->render('actualites/index.html.twig', [
            'user' => $user,
            'actus' => $actus,
            'chocolateries' => $chocolateries
        ]);
    }
}
