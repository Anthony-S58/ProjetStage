<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\Categories1Type;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/categories")
 */
class AdminCategoriesController extends AbstractController
{
    /**
     * @Route("/", name="admin_categories_index", methods={"GET"})
     */
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('admin_categories/index.html.twig', [
            'categories' => $categoriesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_categories_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $category = new Categories();
        $form = $this->createForm(Categories1Type::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('admin_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_categories/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_categories_show", methods={"GET"})
     */
    public function show(Categories $category): Response
    {
        return $this->render('admin_categories/show.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_categories_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Categories $category): Response
    {
        $form = $this->createForm(Categories1Type::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_categories/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_categories_delete", methods={"POST"})
     */
    public function delete(Request $request, Categories $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}
