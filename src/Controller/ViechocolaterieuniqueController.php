<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViechocolaterieuniqueController extends AbstractController
{
    /**
     * @Route("/viechocolaterieunique", name="viechocolaterieunique")
     */
    public function index(): Response
    {
        return $this->render('viechocolaterieunique/index.html.twig', [
            'controller_name' => 'ViechocolaterieuniqueController',
        ]);
    }
}
