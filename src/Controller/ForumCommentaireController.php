<?php

namespace App\Controller;

use App\Entity\ForumCommentaire;
use App\Form\ForumCommentaireType;
use App\Repository\ForumCommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/forum/commentaire")
 */
class ForumCommentaireController extends AbstractController
{
    /**
     * @Route("/", name="forum_commentaire_index", methods={"GET"})
     */
    public function index(ForumCommentaireRepository $forumCommentaireRepository): Response
    {
        return $this->render('forum_commentaire/index.html.twig', [
            'forum_commentaires' => $forumCommentaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="forum_commentaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $forumCommentaire = new ForumCommentaire();
        $form = $this->createForm(ForumCommentaireType::class, $forumCommentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($forumCommentaire);
            $entityManager->flush();

            return $this->redirectToRoute('forum_commentaire_index');
        }

        return $this->render('forum_commentaire/new.html.twig', [
            'forum_commentaire' => $forumCommentaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forum_commentaire_show", methods={"GET"})
     */
    public function show(ForumCommentaire $forumCommentaire): Response
    {
        return $this->render('forum_commentaire/show.html.twig', [
            'forum_commentaire' => $forumCommentaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="forum_commentaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ForumCommentaire $forumCommentaire): Response
    {
        $form = $this->createForm(ForumCommentaireType::class, $forumCommentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forum_commentaire_index');
        }

        return $this->render('forum_commentaire/edit.html.twig', [
            'forum_commentaire' => $forumCommentaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forum_commentaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ForumCommentaire $forumCommentaire): Response
    {
        if ($this->isCsrfTokenValid('delete' . $forumCommentaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($forumCommentaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('forum_commentaire_index');
    }
}

