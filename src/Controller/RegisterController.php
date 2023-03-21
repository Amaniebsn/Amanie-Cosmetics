<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/inscription', name: 'register')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher )
{
        $notification = null;

        $user = new User();

        /*
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword); 
        */



        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
           

            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());
            
        if (!$search_email) {
            $plaintextPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
          
            /*
            $mail = new Mail();
            $content = "Hello".$usergetFirstname()."<br/> Welcome to the Amanie Cosmetics website which will allow you to enhance your lips, more than they already are!.<br/>XOXO";
            $mail->send($user->getEmail(), $usergetFirstname(), $content);

            */
            $notification = "Votre compte à bien été creer !";

        } else {
            $notification = "L'adresse e-mail existe déjà !"; 
        }
        
    
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]); 

    }


}