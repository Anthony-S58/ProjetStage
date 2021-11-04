<?php

namespace App\Controller;

use App\Entity\Actualites;
use App\Form\ActualitesType;
use App\Repository\ActualitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/add/actualites")
 */
class AddActualitesController extends AbstractController
{
    /**
     * @Route("/", name="add_actualites_index", methods={"GET"})
     */
    public function index(ActualitesRepository $actualitesRepository): Response
    {
        return $this->render('add_actualites/index.html.twig', [
            'actualites' => $actualitesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="add_actualites_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $actualite = new Actualites();
        $form = $this->createForm(ActualitesType::class, $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($actualite);
            $entityManager->flush();

            return $this->redirectToRoute('add_actualites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('add_actualites/new.html.twig', [
            'actualite' => $actualite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="add_actualites_show", methods={"GET"})
     */
    public function show(Actualites $actualite): Response
    {
        return $this->render('add_actualites/show.html.twig', [
            'actualite' => $actualite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="add_actualites_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Actualites $actualite): Response
    {
        $form = $this->createForm(ActualitesType::class, $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('add_actualites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('add_actualites/edit.html.twig', [
            'actualite' => $actualite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="add_actualites_delete", methods={"POST"})
     */
    public function delete(Request $request, Actualites $actualite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$actualite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($actualite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('add_actualites_index', [], Response::HTTP_SEE_OTHER);
    }

    public function createAction(Request $request)
    {
    // en créant un object Actualites, le constructeur de l'entité Actualites initialise la date à la date du jour.
    // Le formulaire symfony se chargera d'hydrater ton input date avec la valeur du champ date de l'entité Actualites
    $form = $this->createFormBuilder(new Actualites()); //nul besoin de set la date grâce au constructeur
    // ...
    }
}
