<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/modif/profil")
 */
class ModifProfilController extends AbstractController
{
    /**
     * @Route("/", name="modif_profil_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('modif_profil/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="modif_profil_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

             //On récupère les images transmises
        $picture = $form->getData();
        $images = $form->get('photoprofil')->getData();
        if ($images){
            //    On génère un nouveau nom de fichier
            $fichier= md5(uniqid()) . '.' . $images->guessExtension();
            try{
            // On copie le fichier dans le dossier uploads

            $images->move(
                $this->getParameter('images_directory'),
                $fichier
            );
        }
        catch (FileException $e) {
            // ... handle exception if something happens during file upload
         }
            // On stock l'image dans la base de données (son nom)
            $picture->setPhotoprofil($fichier);
        }
            

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('modif_profil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('modif_profil/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="modif_profil_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('modif_profil/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="modif_profil_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {

        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

             //On récupère les images transmises
        $picture = $form->getData();
        $images = $form->get('photoprofil')->getData();
        if ($images){
            //    On génère un nouveau nom de fichier
            $fichier= md5(uniqid()) . '.' . $images->guessExtension();
            try{
            // On copie le fichier dans le dossier uploads

            $images->move(
                $this->getParameter('images_directory'),
                $fichier
            );
        }
        catch (FileException $e) {
            // ... handle exception if something happens during file upload
         }
            // On stock l'image dans la base de données (son nom)
            $picture->setPhotoprofil($fichier);
        }
            

            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profil', [
                'id' => $user->getId()               
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('modif_profil/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="modif_profil_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('modif_profil_index', [], Response::HTTP_SEE_OTHER);
    }
}
