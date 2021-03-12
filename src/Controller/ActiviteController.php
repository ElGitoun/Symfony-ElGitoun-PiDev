<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class ActiviteController extends AbstractController
{
    /**
     * @Route("/activite", name="activite")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    { 
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);
        $donnees= [];

        if($form->isSubmitted() && $form->isValid()) {
            //on récupère le nom d'article tapé dans le formulaire
             $title = $propertySearch->getTitle();  
              
             if ($title!="") 
               
               $donnees= $this->getDoctrine()->getRepository(Activite::class)->findBy(['title' => $title] );
             else   
               
               $donnees= $this->getDoctrine()->getRepository(Activite::class)->findAll();
            }
        
        
         
        $activities = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1), 
            2 
        );  
        $donneees= $this->getDoctrine()->getRepository(Activite::class)->findAll();
        $activitiees = $paginator->paginate(
            $donneees, 
            $request->query->getInt('page', 1), 
            4 
        );  
        return $this->render('activite/index.html.twig', [
            'form' =>$form->createView(),  'activities' => $activities, 'activitiees' => $activitiees
        ]);
    }
}
