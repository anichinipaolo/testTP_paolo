<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}