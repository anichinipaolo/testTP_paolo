<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $manager): Response
    {

        $contact = new Contact;
        
        
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
// dd($contact);
            $manager->persist($contact); // previent doctrine que l'on veut sauver on persiste dans le temps
            $manager->flush(); // envoi la requête à la base de donnée
            $this->addFlash(
                'success',
                "Le message a bien été envoyé"
                );
                return $this->redirectToRoute('app_home');

        }

        return $this->render('contact/index.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
