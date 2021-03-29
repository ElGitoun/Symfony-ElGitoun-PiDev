<?php

namespace App\Controller;

use App\Entity\PublicationEquipement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterielController extends AbstractController
{
    /**
     * @Route("/home/materiel", name="materiel_index_front")
     */
    public function indexFront(): Response
    {
        return $this->render('FrontOffice/materiel/index.html.twig', [
            'controller_name' => 'MaterielController',
        ]);
    }


    /**
     * @Route("/admin/materiel", name="materiel_index_back")
     */
    public function indexBack(): Response
    {
        return $this->render('BackOffice/materiel/index.html.twig', [
            'controller_name' => 'MaterielController',
        ]);
    }









/**
     * @Route("/home/materiel", name="materiel_index_front")
     */
    public function affichageBack(){
        $repo=$this->getDoctrine()->getManager()->getRepository(PublicationEquipement::class)->findAll();
        return $this->render('FrontOffice/materiel/index.html.twig', [
            'Materiel' => $repo,
        ]); 
    }

    /**
     * @Route("/home/materiel", name="materiel_index_back")
     */
    public function affichage(){
        $repo=$this->getDoctrine()->getManager()->getRepository(PublicationEquipement::class)->findAll();
        return $this->render('materiel/index.html.twig', [
            'Materiel' => $repo,
        ]);
    }








}
