<?php

namespace App\Controller;

use App\Class\Cart;
use App\Entity\Address;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAddressController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/account/addresses', name: 'app_account_address')]
   
    public function index(): Response
   
    {

        return $this->render('account/address.html.twig');
    }

    #[Route('/account/ajouter-une-addresse', name: 'app_account_adress_add')]
   
    public function add(Request $request): Response

    {
        $address = new Address();

        $form = $this->createForm(AddressType::class, $address);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $address->setUser($this->getUser());
            $this->entityManager->persist($address);
            $this->entityManager->flush();
            
    }
        return $this->render('account/address_add.html.twig', [
            'form' => $form->createView()
        ]);
    }

   
    #[Route('/account/modifier-une-addresse/(id)', name: 'app_account_adress_edit')]
   
    public function edit(Request $request, $id): Response

    {
        $address = $this->entityManager->getRepository(Address::class)->findOneById($id);
       
        if (!address || $address->getUser() != $this->getUser()) {
            return $this->redirectToRoute('account_address');
        }

        $form = $this->createForm( AddressType::class, $address);
        


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            return $this->redirectToRoute('account_address');
        }

        return $this->render('account/address_form/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/account/supprimer-une-addresse/(id)', name: 'app_account_address_delete')]
   
    public function delete($id): Response

    {
        $address = $this->entityManager->getRepository(Address::class)->findOneById($id);
       
        if ($address && $address->getUser() == $this->getUser()) {
            $this->entityManager->remove($address);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute( 'account_address');
        
    }

}

