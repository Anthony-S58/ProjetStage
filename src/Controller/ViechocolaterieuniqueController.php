<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Post;

class ViechocolaterieuniqueController extends AbstractController
{
    /**
     * @Route("/viechocolaterieunique/{id}", name="viechocolaterieunique")
     */
    public function index($id): Response
    {
        $user = $this->getUser();
        $users = $this->getDoctrine()->getRepository(User::class)->findBy([], ['id' => 'DESC']);
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);



        return $this->render('viechocolaterieunique/index.html.twig', [
            'user' => $user,
            'users' => $users,
            'post' => $post
        ]);
    }
}
