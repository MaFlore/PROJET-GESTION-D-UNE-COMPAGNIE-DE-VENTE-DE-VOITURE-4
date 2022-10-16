<?php

namespace App\Controller;

use App\Entity\Gerant;
use App\Form\PersonneType;
use App\Repository\GerantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class GerantController extends AbstractController
{
    #[Route('/afficheGerant/{id<\d+>}', name: 'afficherGerant')]
    public function afficherGerant(RequestStack $requestStack, GerantRepository $gerantRepository, Gerant $gerant)
    {

        $gerant =$gerantRepository->find($gerant);
        $session = $requestStack->getSession();
        $nomUtilisateur=$session->get('nomUtilisateur');
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');
        $nomRole=$session->get('nomRole');

        if ($nomUtilisateur==null) {
            return $this->redirectToRoute("authentification");
        }
        return $this->render('Gerant/afficheGerant.html.twig', [

            'gerant'=>$gerant,
            'nom'=>$nom,
            'prenom'=>$prenom,
            'nomRole'=>$nomRole

        ]);


    }


    #[Route('/ajoutGerant', name: 'ajouterGerant')]

    public function addAdministrateur(RequestStack $requestStack, Request $request, EntityManagerInterface $em)
    {
        $gerant = new Gerant();
        
        $session = $requestStack->getSession();
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');

        $form=$this->createForm(PersonneType::class, $gerant);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           //$hashdePassword = $passwordHasher->hashPassword($Administrateur, $Administrateur->getPassword());
           //$Administrateur -> setPassword($hashdePassword);
        
           $em -> persist($gerant);
           $gerant -> setNomRole("Gérant");
           $gerant -> setCreerPar($nom." ".$prenom);
           $date = new \DateTime('@'.strtotime('now'));
           $gerant -> setCreerLe($date);
           $em ->flush();

           return $this->redirectToRoute('gerant');
  
        }
        return $this->render('Gerant/addGerant.html.twig',array(
            'form'=>$form->createView(), 

        ));
    }

    #[Route("modifieGerant/{id<\d+>}", name: "modifierGerant")]

    public function modifierAdmin(RequestStack $requestStack, Request $request, Gerant $gerant, EntityManagerInterface $em)
    {
       
        $session = $requestStack->getSession();
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');
        
        $form=$this->createForm(PersonneType::class, $gerant);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           //$admin -> setRole("Administrateur");
           $gerant -> setModifierPar($nom." ".$prenom);
           $date = new \DateTime('@'.strtotime('now'));
           $gerant -> setModifierLe($date);
           $em->flush();

           return $this->redirectToRoute('gerant');
  
        }

        return $this->render('Gerant/updateGerant.html.twig',[
            'form'=>$form->createView(),
            

        ]);
    }

    #[Route("/supprimerGerant/{id<\d+>}", name : "suppressionGerant")]

    public function supprimerGerant(Request $request, Gerant $gerant, EntityManagerInterface $em)
    {
          $em ->remove($gerant);
          $em ->flush();

          return $this->redirectToRoute('gerant');

       
    }

    #[Route('/gerant', name: 'gerant')]
    public function listeGerant(RequestStack $requestStack,Request $request, GerantRepository $gerantRepository)
    {
        $session = $requestStack->getSession();
        $nomUtilisateur=$session->get('nomUtilisateur');
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');
        $nomRole=$session->get('nomRole');

        if ($nomUtilisateur==null) {
            return $this->redirectToRoute("authentification");
        }
        $gerants=$gerantRepository->findAll();

        return $this->render('Gerant/listGerant.html.twig', [

            'gerants'=>$gerants,
            'nom'=>$nom,
            'prenom' => $prenom,
            'nomRole' => $nomRole

            ]);
        }

    }
    

