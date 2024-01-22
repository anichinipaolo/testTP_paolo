<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();

        // la fonction createForm utilise la fonction buildForm de registerType ( on peut éventuellemeent lui transmettre des options vi
        // a createForm - voir plus tard)
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);
        //dump($user); // équivalent de var_dump on peut utiliser dd() => équivalent de dump and die

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($user->getPassword());
            $plaintextPassword = $user->getPassword();

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);
        // dd($hashedPassword);
            $manager->persist($user); // previent doctrine que l'on veut sauver on persiste dans le temps
            $manager->flush(); // envoi la requête à la base de donnée
            $this->addFlash(
                'success',
                "Le compte {$user->getEmail()} a bien été créé"
                );
                return $this->redirectToRoute('app_home');
        }
        return $this->render('register/index.html.twig', [
            "form" => $form->createView(),
            
        ]);
    }
}
