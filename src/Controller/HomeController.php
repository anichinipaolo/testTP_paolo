<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\ServicesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CommentRepository $repo, ServicesRepository $servicesRepository): Response
    {
        $comments = $repo->findAll();
        $services = $servicesRepository->findAll();
// dump($comments);
        return $this->render('home/index.html.twig', [
            'comments' => $comments,
            'services' => $services,
        ]);
    }
}
