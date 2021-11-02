<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Entity\User;


class ViedeschocolateriesController extends AbstractController
{
    /**
     * @Route("/vie-des-chocolateries", name="viedeschocolateries")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        $users = $this->getDoctrine()->getRepository(User::class)->findBy([], ['id' => 'DESC'], 5);
        $posts = $this->getDoctrine()->getRepository(Post::class)->findBy([], ['id' => 'DESC']);

        return $this->render('viedeschocolateries/index.html.twig', [
            'user' => $user,
            'users' => $users,
            'posts' => $posts
        ]);
    }
}
