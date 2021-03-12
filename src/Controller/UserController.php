<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;






class UserController extends AbstractController
{
    /**
     * @var UsersRepository
     
     */
    private $reposytory;
    public function __construct(UsersRepository $repository , EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/user", name="user")
     */
    public function index(UsersRepository $repo): Response
    {
        $user=$repo->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $user,
        ]);
    }


    /**
     * @Route("/user/{id}", name="user.delete" , methods="DELETE")
     * @param Users $users
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response;
     */

    public function delete(Users $users) 
    {
        $this->em->remove($users);
        $this->em->flush();
        $this->addFlash('success', 'bien supprimer avec succés');
        
        return $this->redirectToRoute('admin.activite.index');
    }
  
}
