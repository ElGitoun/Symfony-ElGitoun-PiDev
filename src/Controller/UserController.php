<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;



class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(UserRepository $repo): Response
    {
        $user=$repo->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $user,
        ]);
    }
  
}
