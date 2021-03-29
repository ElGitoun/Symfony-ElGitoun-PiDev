<?php

namespace App\Controller;

use App\Form\EchangematerielType;
use App\Repository\PublicationEquipementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('base_admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route("/adminproduct", name="adminproduct")
     */
    public function affichage(PublicationEquipementRepository $repo,Request $request){
        $paginator  = $this->get('knp_paginator');
        $materiel = $paginator->paginate(
            $repo->findall() ,
            $request->query->getInt('page', 1),
            5
        );  
        return $this->render('admin/index.html.twig', [
            'Materiel' => $materiel,
        ]); 
        
    }
        /**
     * @param $id
     * @param PublicationEquipementRepository $repo
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/updateadmin{id}",name="updateadminM")
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
            return $this->redirectToRoute("adminproduct");
        }
        return $this->render("admin/update.html.twig", [
            "form" => $form->createView()
        ]);
    }
    /**
     * @param $id
     * @param PublicationEquipementRepository $repo
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("admindelete/{id}",name="admindelete")
     */
    public function delete($id,PublicationEquipementRepository $repo){
        $materiel=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($materiel);
        $em->flush();
        return $this->redirectToRoute("adminproduct");
    }
      /**
     * @Route("/adminshow{id}", name="adshow")
     */
    public function show(PublicationEquipementRepository $repo,$id){
        $materiel=$repo->find($id);
        return $this->render('admin/show.html.twig', [
            'materiel' => $materiel,
        ]); 
}
 /**
     * @Route("adlatest",name="adlatest")
     */
    public function latest(PublicationEquipementRepository $repo,Request $request){

        $paginator  = $this->get('knp_paginator');
       $materiel = $paginator->paginate(
           $repo->adfindlatest() ,
           $request->query->getInt('page', 1),
           5
       );  

       return $this->render('admin/index.html.twig', [
           'Materiel' => $materiel,
       ]); 
       }
       /**
     * @Route("adtridesc",name="adtridesc")
     */
    public function triDesc(PublicationEquipementRepository $repo,Request $request){
        
        $paginator  = $this->get('knp_paginator');
        $materiel = $paginator->paginate(
            $repo->adtridesc() ,
            $request->query->getInt('page', 1),
            5
        );  
 
        return $this->render('admin/index.html.twig', [
            'Materiel' => $materiel,
        ]); 
       }
        /**
     * @Route("adtriasc",name="adtriasc")
     */
    public function triasc(PublicationEquipementRepository $repo,Request $request){

        $paginator  = $this->get('knp_paginator');
        $materiel = $paginator->paginate(
            $repo->adtriasc() ,
            $request->query->getInt('page', 1),
            5
        );  
        return $this->render('admin/index.html.twig', [
            'Materiel' => $materiel,
        ]); 
       }
}