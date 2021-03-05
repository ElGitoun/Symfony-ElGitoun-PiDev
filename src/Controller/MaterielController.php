<?php

namespace App\Controller;

use App\Entity\PublicationEquipement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterielController extends AbstractController
{
    /**
     * @Route("/materiel", name="materiel")
     */
    public function index(): Response
    {
        return $this->render('materiel/index.html.twig', [
            'controller_name' => 'MaterielController',
        ]);
    }
    /**
     * @Route("/materiel", name="materiel")
     */
    public function affichage(){
        $repo=$this->getDoctrine()->getManager()->getRepository(PublicationEquipement::class)->findAll();
        return $this->render('materiel/index.html.twig', [
            'Materiel' => $repo,
        ]); 
    }


}
