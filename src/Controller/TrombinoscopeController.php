<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrombinoscopeController extends AbstractController
{
    /**
     * @Route("/trombinoscope", name="trombinoscope")
     */
    public function index(): Response
    {
        $user = $this->getUser();

        $users = $this->getDoctrine()->getRepository(User::class)->findBy([], ['id' => 'DESC']);
        return $this->render('trombinoscope/index.html.twig', [
            'user' => $user,
            'users' => $users
        ]);
    }
}
