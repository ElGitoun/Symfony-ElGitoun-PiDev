<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Entity\ActiviteSearch;
use App\Entity\PropertySearch;
use App\Entity\ReservationActivite;
use App\Entity\Users;
use App\Form\ActiviteSearchType;
use App\Form\PropertySearchType;
use App\Form\ReservationActiviteType;
use App\Repository\ActiviteRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class ActiviteController extends AbstractController
{
    public function __construct(ActiviteRepository $repository)
    {
     $this->repository = $repository;

    }

    /**
     * @Route("/activite", name="activite")
     */
    public function index(Request $request, PaginatorInterface $paginator , AuthenticationUtils $authenticationUtils): Response
    { 
        
        $lastUsername = $authenticationUtils->getLastUsername();
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);
        $donnees= [];
        
        $search = new ActiviteSearch();
        $formm = $this->createForm(ActiviteSearchType::class,$search);
        $formm->handleRequest($request);

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
        $donneees= $this->repository->findAllVisibleQuery($search);
        $activitiees = $paginator->paginate(
            $donneees, 
            $request->query->getInt('page', 1), 
            4 
        );  
        return $this->render('activite/index.html.twig', [ 'last_username' => $lastUsername,
            'form' =>$form->createView(), 'formm'=> $formm->createView(),  'activities' => $activities, 'activitiees' => $activitiees
        ]);
    }

    /**
     * @Route("/activite{id}", name="activite_show" , requirements={"id":"\d+"} , methods={"GET|POST"})
     * @param Activite $activite
     */
    public function show(ActiviteRepository $repo , $id , Activite $activite , Request $request , AuthenticationUtils $authenticationUtils): Response
    {
        $reservationactivite = new ReservationActivite();
        $email = $authenticationUtils->getLastUsername();

        $activite=$repo->find($id);
        $reservationactivite->setEmail($email);
        $reservationactivite->setActivite($activite);
        $form = $this->createForm(ReservationActiviteType::class, $reservationactivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
           

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservationactivite);
            $entityManager->flush();
            // do anything else you need here, like send an email

            
        }
        return $this->render('activite/show.html.twig', [
            'activite' => $activite, 'form' => $form->createView(),
        ]);
    }

    
    
}
