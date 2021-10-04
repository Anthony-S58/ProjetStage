<?php

namespace App\Controller;

use App\Entity\Chocolaterie;
use App\Form\ChocolaterieType;
use App\Repository\ChocolaterieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chocolaterie")
 */
class ChocolaterieController extends AbstractController
{
    /**
     * @Route("/", name="chocolaterie_index", methods={"GET"})
     */
    public function index(ChocolaterieRepository $chocolaterieRepository): Response
    {
        return $this->render('chocolaterie/index.html.twig', [
            'chocolateries' => $chocolaterieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="chocolaterie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $chocolaterie = new Chocolaterie();
        $form = $this->createForm(ChocolaterieType::class, $chocolaterie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chocolaterie);
            $entityManager->flush();

            return $this->redirectToRoute('chocolaterie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chocolaterie/new.html.twig', [
            'chocolaterie' => $chocolaterie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="chocolaterie_show", methods={"GET"})
     */
    public function show(Chocolaterie $chocolaterie): Response
    {
        return $this->render('chocolaterie/show.html.twig', [
            'chocolaterie' => $chocolaterie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="chocolaterie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Chocolaterie $chocolaterie): Response
    {
        $form = $this->createForm(ChocolaterieType::class, $chocolaterie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chocolaterie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chocolaterie/edit.html.twig', [
            'chocolaterie' => $chocolaterie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="chocolaterie_delete", methods={"POST"})
     */
    public function delete(Request $request, Chocolaterie $chocolaterie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chocolaterie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chocolaterie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chocolaterie_index', [], Response::HTTP_SEE_OTHER);
    }
}
