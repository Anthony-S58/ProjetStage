<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViedeschocolateriesController extends AbstractController
{
    /**
     * @Route("/vie-des-chocolateries", name="viedeschocolateries")
     */
    public function index(): Response
    {
        return $this->render('viedeschocolateries/index.html.twig', [
            'controller_name' => 'ViedeschocolateriesController',
        ]);
    }
}
