<?php

namespace App\Controller\admin;

use App\Entity\Activite;
use App\Form\ActiviteType;
use App\Repository\ActiviteRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActiviteController extends AbstractController
{
    /**
     * @var ActiviteRepository
     
     */
    private $reposytory;
    public function __construct(ActiviteRepository $repository , EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.activite.index")
     * @return \Symfony\Component\HttpFoundation\Response;
     */

    public function index() 
    {
        $activities =$this->repository->findAll();
        return $this->render('admin/activite/index.html.twig',compact('activities'));
    }
    /**
     * @Route("/admin/activite/create", name="admin.activite.new")
     * @return \Symfony\Component\HttpFoundation\Response;
     */

    public function new(Request $request) 
    {
        $activite = new Activite();
        $form=$this->createForm(ActiviteType::class,  $activite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($activite);

            $this->em->flush();
            $this->addFlash('success', 'bien ajouter avec succés');
            return $this->redirectToRoute('admin.activite.index');

        }
        return $this->render('admin/activite/new.html.twig', [
            'activite' => $activite,
            'form' => $form->createView()
            
            ]);
    }
    /**
     * @Route("/admin/{id}", name="admin.activite.edit", methods="GET|POST")
     * @param Activite $activite
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response;
     */

    public function edit(Activite $activite , Request $request) 
    {
        $form=$this->createForm(ActiviteType::class,  $activite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'bien modifier avec succés');
            return $this->redirectToRoute('admin.activite.index');

        }
        return $this->render('admin/activite/edit.html.twig', [
            'activite' => $activite,
            'form' => $form->createView()
            
            ]);
    }
    /**
     * @Route("/admin/{id}", name="admin.activite.delete" , methods="DELETE")
     * @param Activite $activite
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response;
     */

    public function delete(Activite $activite) 
    {
        $this->em->remove($activite);
        $this->em->flush();
        $this->addFlash('success', 'bien supprimer avec succés');
        
        return $this->redirectToRoute('admin.activite.index');
    }

}
