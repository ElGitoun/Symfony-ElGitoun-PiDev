<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Entity\User;
use App\Form\FeedbackType;
use App\Repository\FeedbackRepository;
use App\Repository\PublicationEquipementRepository;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends Controller
{
    /**
     * @Route("/feedback", name="feedback")
     */
    public function index(): Response
    {
        return $this->render('feedback/index.html.twig', [
            'controller_name' => 'FeedbackController',
        ]);
    }
    /**
     * @Route("/feedback{id}", name="feedback")
     */
    public function feedback(UserRepository $repo,$id,FeedbackRepository $feedrepo,PublicationEquipementRepository $matrepo,Request $request): Response
    {
        $paginator  = $this->get('knp_paginator');

        $user=$repo->find($id);


        $feedbacks=  $paginator->paginate(
            $feedrepo->findBy(["user"=>$id]),
            $request->query->getInt('page', 1),
            3);
        return $this->render('feedback/index.html.twig', [
            'user' => $user,
            'feedback'=>$feedbacks,

        ]);
    }
    

     /**
     * @Route("/addfeedback{id}", name="addfeedback")
     */
    public function ajouter(UserRepository $repo,$id,Request $request)
    {
        $feedback = new Feedback();
        $user=$repo->find($id);
        $feedback->setUser($user);

        $form = $this->createForm(FeedbackType::class, $feedback);
        

        $form->add("ajouter", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($feedback);
            $em->flush();
            return $this->redirectToRoute("visible");
        }
        return $this->render("feedback/ajoutF.html.twig", [
            "form" => $form->createView()
        ]);
    }
    
}
