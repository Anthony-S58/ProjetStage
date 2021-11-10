<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use App\Repository\EmployeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/employe")
 */
class EmployeController extends AbstractController
{
    /**
     * @Route("/", name="admin_employe_index", methods={"GET"})
     */
    public function index(EmployeRepository $employeRepository): Response
    {
        return $this->render('admin_employe/index.html.twig', [
            'employes' => $employeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_employe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $employe = new Employe();
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($employe);
            $entityManager->flush();

            return  $this->redirectToRoute('admin_employe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_employe/new.html.twig', [
            'employe' => $employe,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_employe_show", methods={"GET"})
     */
    public function show(Employe $employe): Response
    {
        return $this->render('admin_employe/show.html.twig', [
            'employe' => $employe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_employe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Employe $employe): Response
    {
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_employe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_employe/edit.html.twig', [
            'employe' => $employe,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_employe_delete", methods={"POST"})
     */
    public function delete(Request $request, Employe $employe): Response
    {
        if ($this->isCsrfTokenValid('delete' . $employe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_employe_index', [], Response::HTTP_SEE_OTHER);
    }
}
