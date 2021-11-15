<?php

namespace App\Controller;

use App\Entity\Actualites;
use App\Form\Actualites1Type;
use App\Repository\ActualitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/actualites")
 */
class AdminActualitesController extends AbstractController
{
    /**
     * @Route("/", name="admin_actualites_index", methods={"GET"})
     */
    public function index(ActualitesRepository $actualitesRepository): Response
    {
        return $this->render('admin_actualites/index.html.twig', [
            'actualites' => $actualitesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_actualites_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $actualite = new Actualites();
        $form = $this->createForm(Actualites1Type::class, $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($actualite);
            $entityManager->flush();

            return $this->redirectToRoute('admin_actualites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_actualites/new.html.twig', [
            'actualite' => $actualite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_actualites_show", methods={"GET"})
     */
    public function show(Actualites $actualite): Response
    {
        return $this->render('admin_actualites/show.html.twig', [
            'actualite' => $actualite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_actualites_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Actualites $actualite): Response
    {
        $form = $this->createForm(Actualites1Type::class, $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_actualites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_actualites/edit.html.twig', [
            'actualite' => $actualite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_actualites_delete", methods={"POST"})
     */
    public function delete(Request $request, Actualites $actualite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$actualite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($actualite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_actualites_index', [], Response::HTTP_SEE_OTHER);
    }
}
