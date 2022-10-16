<?php

namespace App\Controller;

use App\Entity\Administrateur;
use App\Form\PersonneType;
use App\Repository\AdministrateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class AdministrateurController extends AbstractController
{
    #[Route('/afficheAdmin/{id<\d+>}', name: 'afficherAdmin')]
    public function afficherAdmin(RequestStack $requestStack, AdministrateurRepository $AdministrateurRepository, Administrateur $admin)
    {

        $admin =$AdministrateurRepository->find($admin);
        $session = $requestStack->getSession();
        $nomUtilisateur=$session->get('nomUtilisateur');
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');
        $nomRole=$session->get('nomRole');

        if ($nomUtilisateur==null) {
            return $this->redirectToRoute("authentification");
        }
        return $this->render('Administrateur/afficheAdmin.html.twig', [

            'admin'=>$admin,
            'nom'=>$nom,
            'prenom'=>$prenom,
            'nomRole'=>$nomRole

        ]);


    }


    #[Route('/ajoutAdmin', name: 'ajouterAdmin')]

    public function addAdministrateur(RequestStack $requestStack, Request $request, EntityManagerInterface $em)
    {
        $admin = new Administrateur();

        $session = $requestStack->getSession();
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');

        $form=$this->createForm(PersonneType::class, $admin);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           //$hashdePassword = $passwordHasher->hashPassword($Administrateur, $Administrateur->getPassword());
           //$Administrateur -> setPassword($hashdePassword);
        
           $em -> persist($admin);
           $admin -> setNomRole("Administrateur");
           $admin -> setCreerPar($nom." ".$prenom);
           $date = new \DateTime('@'.strtotime('now'));
           $admin -> setCreerLe($date);
           $em ->flush();

           return $this->redirectToRoute('administrateur');
  
        }
        return $this->render('Administrateur/addAdmin.html.twig',array(
            'form'=>$form->createView(), 

        ));
    }

    #[Route("modifieAdmin/{id<\d+>}", name: "modifierAdmin")]

    public function modifierAdmin(RequestStack $requestStack, Request $request, Administrateur $admin, EntityManagerInterface $em)
    {
       
        $session = $requestStack->getSession();
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');
        
        $form=$this->createForm(PersonneType::class, $admin);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           $admin -> setModifierPar($nom." ".$prenom);
           $date = new \DateTime('@'.strtotime('now'));
           $admin -> setModifierLe($date);
           //$admin -> setRole("Administrateur");
           $em->flush();

           return $this->redirectToRoute('administrateur');
  
        }

        return $this->render('Administrateur/updateAdmin.html.twig',array(
            'form'=>$form->createView(),
            

        ));
    }

    #[Route("/supprimerAdmin/{id<\d+>}", name : "suppressionAdmin")]

    public function supprimerAdmin(Request $request, Administrateur $admin, EntityManagerInterface $em)
    {
          $em ->remove($admin);
          $em ->flush();

          return $this->redirectToRoute('administrateur');

       
    }

    #[Route('/administrateur', name: 'administrateur')]
    public function listeAdmin(RequestStack $requestStack,Request $request, AdministrateurRepository $AdministrateurRepository)
    {
        $session = $requestStack->getSession();
        $nomUtilisateur=$session->get('nomUtilisateur');
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');
        $nomRole=$session->get('nomRole');

        if ($nomUtilisateur==null) {
            return $this->redirectToRoute("authentification");
        }
        $admins=$AdministrateurRepository->findAll();

        return $this->render('Administrateur/listAdmin.html.twig', [

          'admins'=>$admins,
          'nom'=>$nom,
          'prenom' => $prenom,
          'nomRole' => $nomRole

            ]);
        }

    }
    

