<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Postimg;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


/**
 * @Route("/post")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="post_index", methods={"GET"})
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="post_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = $this->getUser();
        $post = new Post();
        $postimg = new Postimg();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //On récupère les images transmises
        $picture = $form->getData();
        $image = $form->get('image')->getData();
        if ($image){
            //    On génère un nouveau nom de fichier
            $fichier= md5(uniqid()) . '.' . $image->guessExtension();
            try{
            // On copie le fichier dans le dossier uploads

            $image->move(
                $this->getParameter('images_directory'),
                $fichier
            );
            }

            catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            // On stock l'image dans la base de données (son nom)
            $postimg->setImage($fichier);
        }


            $post->setUser($user);
            $postimg->setPost($post);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->persist($postimg);
            $entityManager->flush();

            return $this->redirectToRoute('profil', [
                'id' => $user->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/new.html.twig', [
            'post' => $post,
            'form' => $form,
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}", name="post_show", methods={"GET"})
     */
    public function show(Post $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="post_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Post $post): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="post_delete", methods={"POST"})
     */
    public function delete(Request $request, Post $post): Response
    {

        $user = $this->getUser();

        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('profil', [
            'id' => $user->getId()               
        ], Response::HTTP_SEE_OTHER);;
    }

    public function createAction(Request $request)
    {
    // en créant un object Post, le constructeur de l'entité Post initialise la date à la date du jour.
    // Le formulaire symfony se chargera d'hydrater l'input date avec la valeur du champ date de l'entité Post
    $form = $this->createFormBuilder(new Post()); //nul besoin de set la date grâce au constructeur
    // ...
    }
}
