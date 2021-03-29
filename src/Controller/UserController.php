<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;



class UserController extends AbstractController
{
    /**
     * @Route("/home/user", name="user_index_front")
     */
    public function indexfront(UserRepository $repo): Response
    {
        $user=$repo->findAll();
        return $this->render('/FrontOffice/user/index.html.twig', [
            'users' => $user,
        ]);
    }
  





/**
 * @Route("/admin/user", name="user_index_back")
 */
public function indexback(UserRepository $repo): Response
{
    $user=$repo->findAll();
    return $this->render('/BackOffice/user/index.html.twig', [
        'users' => $user,
    ]);
}

}