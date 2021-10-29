<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('index/index.html.twig', [
            'user' => $user

        ]);
    }
}
