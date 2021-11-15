<?php

namespace App\Controller;

use App\Entity\Chocolaterie;
use App\Form\Chocolaterie1Type;
use App\Repository\ChocolaterieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/chocolaterie")
 */
class AdminChocolaterieController extends AbstractController
{
    /**
     * @Route("/", name="admin_chocolaterie_index", methods={"GET"})
     */
    public function index(ChocolaterieRepository $chocolaterieRepository): Response
    {
        return $this->render('admin_chocolaterie/index.html.twig', [
            'chocolateries' => $chocolaterieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_chocolaterie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $chocolaterie = new Chocolaterie();
        $form = $this->createForm(Chocolaterie1Type::class, $chocolaterie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chocolaterie);
            $entityManager->flush();

            return $this->redirectToRoute('admin_chocolaterie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_chocolaterie/new.html.twig', [
            'chocolaterie' => $chocolaterie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_chocolaterie_show", methods={"GET"})
     */
    public function show(Chocolaterie $chocolaterie): Response
    {
        return $this->render('admin_chocolaterie/show.html.twig', [
            'chocolaterie' => $chocolaterie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_chocolaterie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Chocolaterie $chocolaterie): Response
    {
        $form = $this->createForm(Chocolaterie1Type::class, $chocolaterie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_chocolaterie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_chocolaterie/edit.html.twig', [
            'chocolaterie' => $chocolaterie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_chocolaterie_delete", methods={"POST"})
     */
    public function delete(Request $request, Chocolaterie $chocolaterie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chocolaterie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chocolaterie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_chocolaterie_index', [], Response::HTTP_SEE_OTHER);
    }
}
