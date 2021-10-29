<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(): Response
    {
        $user = $this->getUser();

        $posts = $this->getDoctrine()->getRepository(Post::class)->findBy(['user' => $user], ['id' => 'DESC']);

        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
