<?php

namespace App\Controller;

use App\Entity\PublicationEquipement;
use App\Form\EchangematerielType;
use App\Repository\PublicationEquipementRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterielController extends Controller
{
    /**
     * @Route("/materiel", name="materiel")
     */
    public function index(): Response
    {   $repo=$this->getDoctrine()->getManager()->getRepository(PublicationEquipement::class)->findAll();
        return $this->render('materiel/index.html.twig', [
            'controller_name' => 'MaterielController',
        ]);
    }
    /**
     * @Route("/allmateriel", name="allmateriel")
     */
    public function affichage(PublicationEquipementRepository $repo){
        $materiel=$repo->findAll();
        return $this->render('materiel/index.html.twig', [
            'materiel' => $materiel,
        ]); 
    }

    /**
     * @Route("/materiel{id}", name="show")
     */
    public function show(PublicationEquipementRepository $repo,$id){
        $materiel=$repo->find($id);
        return $this->render('materiel/show.html.twig', [
            'materiel' => $materiel,
        ]); 
    }
    /**
     * @Route("/mesmateriel", name="mesmateriel")
     */
    public function affichagebyuser(PublicationEquipementRepository $repo,Request $request){
        $paginator  = $this->get('knp_paginator');
        $materiel = $paginator->paginate(
            $repo->findallbyuser() ,
            $request->query->getInt('page', 1),
            8
        );  
        return $this->render('materiel/mesmateriel.html.twig', [
            'materiel' => $materiel,
        ]); 
    }
     /**
     * @Route("/addmateriel", name="addmateriel")
     */
    public function ajouter(Request $request)
    {
        $materiel = new PublicationEquipement();
        $form = $this->createForm(EchangematerielType::class, $materiel);
        $form->add("ajouter", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($materiel);
            $em->flush();
            return $this->redirectToRoute("mesmateriel");
        }
        return $this->render("materiel/ajoutM.html.twig", [
            "form" => $form->createView()
        ]);
    }
    /**
     * @param $id
     * @param PublicationEquipementRepository $repo
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/update{id}",name="updateM")
     */
    public function update($id,PublicationEquipementRepository  $repo, Request $request)
    {
        $materiel = $repo->find($id);
        $form = $this->createForm(EchangematerielType::class, $materiel);
        $form->add("update", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("mesmateriel");
        }
        return $this->render("materiel/updateM.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @param $id
     * @param PublicationEquipementRepository $repo
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("deleteM/{id}",name="deleteM")
     */
    public function delete($id,PublicationEquipementRepository $repo){
        $materiel=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($materiel);
        $em->flush();
        return $this->redirectToRoute("mesmateriel");


    }
    /**
     * @Route ("/allmaterielvisible",name="visible")
     */
    public function findallvisible (PublicationEquipementRepository $repo,Request $request ){
        $paginator  = $this->get('knp_paginator');
        $materiel = $paginator->paginate(
            $repo->findallvisible() ,
            $request->query->getInt('page', 1),
            5
        );  

        return $this->render('materiel/index.html.twig', [
            'materiel' => $materiel,
        ]); 
    }
   
    /**
     * @param PublicationEquipementRepository $repository
     * @param Request $request
     * @return Response
     * @Route("recherche",name="recherche")
     */
    public function  recherche (PublicationEquipementRepository $repo ,Request $request){
        $data=$request->get("search");
        $paginator  = $this->get('knp_paginator');
        $materiel = $paginator->paginate(
            $repo->findBy(["title"=>$data]) ,
            $request->query->getInt('page', 1),
            8
        );  
 
        return $this->render('materiel/index.html.twig', [
            'materiel' => $materiel,
        ]); 
    }
    /**
     * @Route("triasc",name="triasc")
     */
    public function triasc(PublicationEquipementRepository $repo,Request $request){

        $paginator  = $this->get('knp_paginator');
        $materiel = $paginator->paginate(
            $repo->triasc() ,
            $request->query->getInt('page', 1),
            5
        );  
        return $this->render('materiel/index.html.twig', [
            'materiel' => $materiel,
        ]); 
       }
        /**
     * @Route("tentes",name="tentes")
     */
    public function findtente(PublicationEquipementRepository $repo,Request $request){

        $paginator  = $this->get('knp_paginator');
       $materiel = $paginator->paginate(
           $repo->findtente() ,
           $request->query->getInt('page', 1),
           8
       );  
       return $this->render('materiel/index.html.twig', [
        'materiel' => $materiel,
    ]); 
       }
       /**
     * @Route("vetements",name="vetements")
     */
    public function findvetements(PublicationEquipementRepository $repo,Request $request){

        $paginator  = $this->get('knp_paginator');
       $materiel = $paginator->paginate(
           $repo->findvetements() ,
           $request->query->getInt('page', 1),
           8
       );  
       return $this->render('materiel/index.html.twig', [
        'materiel' => $materiel,
    ]); 
       }
        /**
     * @Route("sacados",name="sac_ados")
     */
    public function find_sac_ados(PublicationEquipementRepository $repo ,Request $request ){

        $paginator  = $this->get('knp_paginator');
       $materiel = $paginator->paginate(
           $repo->findsacados() ,
           $request->query->getInt('page', 1),
           8
       );
       return $this->render('materiel/index.html.twig', [
        'materiel' => $materiel,
    ]);   
       }
          /**
     * @Route("find_sac_couchage",name="find_sac_couchage")
     */
    public function find_sac_couchage(PublicationEquipementRepository $repo ,Request $request){

        $paginator  = $this->get('knp_paginator');
       $materiel = $paginator->paginate(
           $repo->findsacdecouchage() ,
           $request->query->getInt('page', 1),
           8
       );  

       return $this->render('materiel/index.html.twig', [
           'materiel' => $materiel,
       ]); 
       }
          /**
     * @Route("autre",name="autre")
     */
    public function findautre(PublicationEquipementRepository $repo,Request $request){

        $paginator  = $this->get('knp_paginator');
       $materiel = $paginator->paginate(
           $repo->findautre() ,
           $request->query->getInt('page', 1),
           8
       );  

       return $this->render('materiel/index.html.twig', [
           'materiel' => $materiel,
       ]); 
       }
         /**
     * @Route("tridesc",name="tridesc")
     */
    public function triDesc(PublicationEquipementRepository $repo,Request $request){
        
        $paginator  = $this->get('knp_paginator');
        $materiel = $paginator->paginate(
            $repo->tridesc() ,
            $request->query->getInt('page', 1),
            5
        );  
 
        return $this->render('materiel/index.html.twig', [
            'materiel' => $materiel,
        ]); 
       }
        /**
     * @Route("latest",name="latest")
     */
    public function latest(PublicationEquipementRepository $repo,Request $request){

        $paginator  = $this->get('knp_paginator');
       $materiel = $paginator->paginate(
           $repo->findlatest() ,
           $request->query->getInt('page', 1),
           5
       );  

       return $this->render('materiel/index.html.twig', [
           'materiel' => $materiel,
       ]); 
       }
          /**
     * @Route("oldest",name="oldest")
     */
    public function oldest(PublicationEquipementRepository $repo,Request $request){
       $paginator  = $this->get('knp_paginator');
       $materiel = $paginator->paginate(
           $repo->findoldest() ,
           $request->query->getInt('page', 1),
           8
       );  

       return $this->render('materiel/index.html.twig', [
           'materiel' => $materiel,
       ]); 
      

}
     /**
     * @Route("usermateriel{id}",name="usermateriel")
     */

    public function usermateriel (PublicationEquipementRepository $repo,UserRepository $repository,$id,Request $request) {
        $paginator  = $this->get('knp_paginator');
        $user=$repository->find($id);

        $materiel = $paginator->paginate(
            $repo->findBy(["user"=>$id]) ,
            $request->query->getInt('page', 1),
            5
        );  
 
        return $this->render('materiel/usermateriel.html.twig', [
            'user'=>$user,
            'materiel' => $materiel
        ]); 
    }
}
