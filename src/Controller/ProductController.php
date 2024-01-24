<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Products;
use App\Form\ContactType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(ProductRepository $repo): Response
    {

        $products = $repo->findAll(); 
        // dump($products); 

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController', 
            'products' => $products,
        ]);
    }

    #[Route(path: '/product/{id}', name: 'product')]
    public function show(Products $product, Request $request, EntityManagerInterface $manager): Response
    {

        $contact = new Contact;
        
        $contact->setSujet($product->getTitre());
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
        // $session = $request->getSession();
        // $cart = $session->get('cart', []);
        return $this->render('product/show.html.twig', [
            'product' => $product,
            "form" => $form->createView(),
            // 'cartNotif' => $cart,
        ]);
    }
}
