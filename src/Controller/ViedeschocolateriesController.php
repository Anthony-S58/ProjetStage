<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViedeschocolateriesController extends AbstractController
{
    /**
     * @Route("/viedeschocolateries", name="viedeschocolateries")
     */
    public function index(): Response
    {
        return $this->render('viedeschocolateries/index.html.twig', [
            'controller_name' => 'ViedeschocolateriesController',
        ]);
    }
}
