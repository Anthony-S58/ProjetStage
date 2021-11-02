<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Employe;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class RegistrationController extends AbstractController
{
    /**
     * @Route("/register-superadmin", name="app_registersuperadmin")
     */

    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setEmail(
                $form->get('email')->getData()
            );
            $user->setUsername(
                $form->get('username')->getData()
            );
            $user->setRoles(
                ['ROLE_SUPER_ADMIN']
            );
            $user->setPoste(
                $form->get('poste')->getData()
            );
            // $user->setDescription(
            //     $form->get('description')->getData()
            // );
            // $user->setPhotoprofil(
            //     $form->get('photoprofil')->getData()
            // );
            // $user->setPhotobandeau(
            //     $form->get('photobandeau')->getData()
            // );
            // $user->setFacebook(
            //     $form->get('facebook')->getData()
            // );
            // $user->setTwitter(
            //     $form->get('twitter')->getData()
            // );
            // $user->setInstagram(
            //     $form->get('instagram')->getData()
            // );
            // $user->setLinkedin(
            //     $form->get('linkedin')->getData()
            // );
            $user->setChocolaterie(
                $form->get('chocolaterie')->getData()
            );
            $user->setPassword(
                $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register-utilisateur", name="app_registerutilisateur")
     */
    public function registerutilisateur(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $user = new User();
        $employe = new Employe();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setEmail(
                $form->get('email')->getData()
            );
            $user->setUsername(
                $form->get('username')->getData()
            );
            $user->setRoles(
                ['ROLE_USER']
            );
            $user->setPoste(
                $form->get('poste')->getData()
            );
            // $user->setDescription(
            //     $form->get('description')->getData()
            // );
            // $user->setPhotoprofil(
            //     $form->get('photoprofil')->getData()
            // );
            // $user->setPhotobandeau(
            //     $form->get('photobandeau')->getData()
            // );
            // $user->setFacebook(
            //     $form->get('facebook')->getData()
            // );
            // $user->setTwitter(
            //     $form->get('twitter')->getData()
            // );
            // $user->setInstagram(
            //     $form->get('instagram')->getData()
            // );
            // $user->setLinkedin(
            //     $form->get('linkedin')->getData()
            // );
            $user->setChocolaterie(
                $form->get('chocolaterie')->getData()
            );


            $user->setPassword(
                $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setEmploye($employe);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->persist($employe);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register-admin", name="app_registeradmin")
     */
    public function registeradmin(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setEmail(
                $form->get('email')->getData()
            );
            $user->setUsername(
                $form->get('username')->getData()
            );
            $user->setRoles(
                ['ROLE_ADMIN']
            );
            $user->setPoste(
                $form->get('poste')->getData()
            );
            // $user->setDescription(
            //     $form->get('description')->getData()
            // );
            // $user->setPhotoprofil(
            //     $form->get('photoprofil')->getData()
            // );
            // $user->setPhotobandeau(
            //     $form->get('photobandeau')->getData()
            // );
            // $user->setFacebook(
            //     $form->get('facebook')->getData()
            // );
            // $user->setTwitter(
            //     $form->get('twitter')->getData()
            // );
            // $user->setInstagram(
            //     $form->get('instagram')->getData()
            // );
            // $user->setLinkedin(
            //     $form->get('linkedin')->getData()
            // );
            $user->setChocolaterie(
                $form->get('chocolaterie')->getData()
            );


            $user->setPassword(
                $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
