<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PublicationForumRepository;
use App\Entity\PublicationForum;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PublicationForumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class ForumController extends AbstractController

{
    


/**
     * @Route("/forum", name="forum")
     */
    public function affichage(PublicationForumRepository $repo){
        $repo=$this->getDoctrine()->getManager()->getRepository(PublicationForum::class)->findAll();
        return $this->render('publication_forum/index.html.twig', [
            'forum' => $repo,
        ]); 
    }


    /**
     * @param $id
     * @param PublicationForumRepository $repo
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("deleteM/{id}",name="deleteM")
     */

    public function delete($id,PublicationForumRepository $repo){
        $post=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute("forum");


    }




    /**
     * @param $id
     * @param PublicationForumRepository $repo
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/updateM/{id}",name="updateM")
     */
    public function update($id,PublicationForumRepository  $repo, Request $request)
    {
        $post = $repo->find($id);
        $form = $this->createForm(PublicationForumType::class, $post);
        $form->add("update", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("forum");
        }
        return $this->render("publication_forum/edit.html.twig", [
            "form" => $form->createView()
        ]);


        }




/**
     * @Route("/addpost", name="addpost")
     */
    public function ajouter(Request $request)
    {
        $post = new PublicationForum();
        $form = $this->createForm(PublicationForumType::class, $post);
                $form->add("ajouter", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $post->getDate=$post->setDate(new \DateTime());
            $post->getImage=$post->setImage("hello" );
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute("forum");
        }
        return $this->render("publication_forum/new.html.twig", [
            "form" => $form->createView()
        ]);
    }






}
