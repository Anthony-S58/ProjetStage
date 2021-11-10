<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Employe;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("admin/utilisateur", name="admin_utilisateur")
     */
    public function index(): Response
    {

        $employes = $this->getDoctrine()->getRepository(Employe::class)->findBy([], ['id' => 'DESC']);
        dump($employes);

        return $this->render('admin_utilisateur/index.html.twig', [
            'employes' => $employes
        ]);
    }
}
