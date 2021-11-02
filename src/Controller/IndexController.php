<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration;
use App\Entity\Post;
use Doctrine\DBAL\Driver\SQLSrv\LastInsertId;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        $postcol1 = $this->getDoctrine()->getRepository(Post::class)->findBy([], ['id' => 'DESC'], 2, 0);
        $postcol2 = $this->getDoctrine()->getRepository(Post::class)->findBy([], ['id' => 'DESC'], 2, 2);
        $postcol3 = $this->getDoctrine()->getRepository(Post::class)->findBy([], ['id' => 'DESC'], 2, 4);


        return $this->render('index/index.html.twig', [
            'user' => $user,
            'postcol1' => $postcol1,
            'postcol2' => $postcol2,
            'postcol3' => $postcol3


        ]);
    }
}
