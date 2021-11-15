<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Categories;
use App\Entity\Actualites;
use App\Entity\Post;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $utilisateurs = $this->getDoctrine()->getRepository(User::class)->findBy([], ['id' => 'DESC']);
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findBy([], ['id' => 'DESC']);
        $actualites = $this->getDoctrine()->getRepository(Actualites::class)->findBy([], ['id' => 'DESC']);
        $post = $this->getDoctrine()->getRepository(Post::class)->findBy([], ['id' => 'DESC']);

        return $this->render('admin/index.html.twig', [
            'utilisateurs' => $utilisateurs,
            'categories' => $categories,
            'actualites' => $actualites,
            'post' => $post,

        ]);
    }
}
