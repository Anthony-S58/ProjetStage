<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Entity\User;


class ProfilController extends AbstractController
{
    /**
     * @Route("/profil/{id}", name="profil")
     */
    public function index($id): Response
    {
        $user = $this->getUser();

        $userid = $this->getDoctrine()->getRepository(User::class)->find($id);

        $posts = $this->getDoctrine()->getRepository(Post::class)->findBy(['user' => $userid], ['id' => 'DESC']);

        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'posts' => $posts,
            'userid' => $userid

        ]);
    }
}
