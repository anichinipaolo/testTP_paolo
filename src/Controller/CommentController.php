<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
    #[Route('/comment', name: 'app_comment')]
    public function index(Request $request, EntityManagerInterface $manager): Response
    {

        $comment = new Comment;
        $form = $this->createForm(CommentType::class, $comment);



        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($contact);
                        $manager->persist($comment); // previent doctrine que l'on veut sauver on persiste dans le temps
                        $manager->flush(); // envoi la requête à la base de donnée
                        $this->addFlash(
                            'success',
                            "Le commentaire a bien été envoyé"
                            );
                            return $this->redirectToRoute('app_home');
            
                    }

        return $this->render('comment/index.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
