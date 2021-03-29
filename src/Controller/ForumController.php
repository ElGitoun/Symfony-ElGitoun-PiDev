<?php

namespace App\Controller;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Util\ClassNameValue;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PublicationForumRepository;
use App\Repository\ForumCommentaireRepository;
use App\Entity\PublicationForum;
use App\Entity\ForumCommentaire;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PublicationForumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\PropertySearchType;
use App\Entity\PropertySearch;

class ForumController extends AbstractController

{


    /**
     * @Route("/home/forum", name="forum_index_front_Search")
     */


    public function rechercheByniveauAction(PaginatorInterface $paginator, Request $request,PublicationForumRepository $repo){
        $em=$this->getDoctrine()->getManager();
        $forum=$em->getRepository(PublicationForum::class)->findAll();
        if($request->isMethod("POST")) {
            $titre=$request->get('titre');
            $forum=$em->getRepository(PublicationForum::class)->findBy(array('titre'=>$titre),array('titre'=>'ASC'));
        }
        $forum= $paginator->paginate($repo->findAll(), $request->query->getInt('page', 1),
            2 );



        return $this->render('/FrontOffice/publication_forum/Search.html.twig',array('forum'=>$forum) );}

   /* /**
     * @Route("/home/pagination", name="forum_index_pagination")
     */

/*
    public function index(PaginatorInterface $paginator, Request $request,PublicationForumRepository $repo)
    {

        $forum= $paginator->paginate($repo->findAll(), $request->query->getInt('page', 1),
            2 );

        return $this->render('/FrontOffice/publication_forum/index.html.twig', ['forum' => $forum]);
    }

*/
    /**
     * @Route("/home/filtre", name="forum_index_front_filtre")
     */
    public function filtreid5(PublicationForumRepository $repo){
        $repo=$this->getDoctrine()->getManager()->getRepository(PublicationForum::class)->filtre();
        return $this->render('/FrontOffice/publication_forum/filtre.html.twig', [
            'forum' => $repo,
        ]);
    }









    /**
     * @Route("/home/forum/comments", name="forum_index_back_comment")
     */
    public function affichageComments(ForumCommentaireRepository $repo){
        $repo=$this->getDoctrine()->getManager()->getRepository(ForumCommentaire::class)->findAll();
        return $this->render('/BackOffice/publication_forum/Comments.html.twig', [
            'Comments' => $repo,
        ]);
    }

    /**
     * @Route("/{id}", name="publication_forum_show", methods={"GET"})
     */
    public function show(PublicationForum $publicationForum): Response
    {
        $publicationForum->setViews( $publicationForum->getViews()+1);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->render('/FrontOffice/publication_forum/show.html.twig', [
            'publicationForum' => $publicationForum,
        ]);
    }





    /**
     * @Route("/admin/forum", name="forum_index_back")
     */
    public function affichageback(PublicationForumRepository $repo){
        $repo=$this->getDoctrine()->getManager()->getRepository(PublicationForum::class)->findAll();
        return $this->render('/BackOffice/publication_forum/index.html.twig', [
            'forum' => $repo,
        ]);
    }

    /**
     * @param $id
     * @param PublicationForumRepository $repo
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/home/deleteM/{id}",name="deleteM_index_front")
     */

    public function deletehome($id,PublicationForumRepository $repo){
        $post=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute("/FrontOffice/forum");


    }
    /**
     * @param $id
     * @param PublicationForumRepository $repo
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/admin/deleteM/{id}",name="deleteM_index_back")
     */

    public function deleteback($id,PublicationForumRepository $repo){
        $post=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute("forum_index_back");
    }



    /**
     * @param $id
     * @param PublicationForumRepository $repo
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/home/updateM/{id}",name="updateM_index_front")
     */
    public function updatefront($id,PublicationForumRepository  $repo, Request $request)
    {
        $post = $repo->find($id);
        $form = $this->createForm(PublicationForumType::class, $post);
        $form->add("update", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("/FrontOffice/forum");
        }
        return $this->render("/FrontOffice/publication_forum/edit.html.twig", [
            "form" => $form->createView()
        ]);
        }




    /**
     * @param $id
     * @param PublicationForumRepository $repo
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/admin/updateM/{id}",name="updateM_index_back")
     */
    public function updateback($id,PublicationForumRepository  $repo, Request $request)
    {
        $post = $repo->find($id);
        $form = $this->createForm(PublicationForumType::class, $post);
        $form->add("update", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("forum_index_back");
        }
        return $this->render("/BackOffice/publication_forum/edit.html.twig", [
            "form" => $form->createView()
        ]);


    }


    /**
     * @Route("/home/addpost", name="addpost_index_front")
     */
    public function ajouterfront(Request $request)
    {
        $post = new PublicationForum();
        $form = $this->createForm(PublicationForumType::class, $post);
                $form->add("ajouter", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setViews(0);
            $em = $this->getDoctrine()->getManager();
            $post->getDate=$post->setDate(new \DateTime());
            $post->getImage=$post->setImage("hello" );
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute("forum_index_front_Search");
        }
        return $this->render("/FrontOffice/publication_forum/new.html.twig", [
            "form" => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/addpost", name="addpost_index_back")
     */
    public function ajouterback(Request $request)
    {
        $post = new PublicationForum();
        $form = $this->createForm(PublicationForumType::class, $post);
        $form->add("ajouter", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $post->getDate=$post->setDate(new \DateTime());
            $post->getImage=$post->setImage("hello" );
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute("forum_index_back");
        }
        return $this->render("/FrontOffice/publication_forum/new.html.twig", [
            "form" => $form->createView()
        ]);
    }



}
