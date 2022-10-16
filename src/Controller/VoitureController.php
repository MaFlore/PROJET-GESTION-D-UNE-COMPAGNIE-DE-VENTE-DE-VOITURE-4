<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    #[Route("/voiture",name: "voiture")]

    public function allVoiture(RequestStack $requestStack, Request $request, VoitureRepository $voitureRepository)
    {

        $session = $requestStack->getSession();
        $nomUtilisateur=$session->get('nomUtilisateur');
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');
        $nomRole=$session->get('nomRole');
        if ($nomUtilisateur==null) {
            return $this->redirectToRoute("authentification");
        }
            if ($request->isMethod(method:"POST"))
            {
                $selectrecherche = $request->get(key:'selectrecherche');
                $searchvoiture = $request->get(key:'searchvoiture');
                $voitures=$voitureRepository->findBy(array($selectrecherche=>$searchvoiture)
                );
                return $this->render('voiture/rechercheVoiture.html.twig',[
                    'voitures'=>$voitures,
                    'nom'=>$nom,
                    'prenom'=>$prenom,
                    'nomRole'=>$nomRole
                ]); 
            }
            else{
                $voitures=$voitureRepository->findAll();

                return $this->render('voiture/listVoiture.html.twig',[
                    'voitures'=>$voitures,
                    'nom'=>$nom,
                    'prenom'=>$prenom,
                    'nomRole'=>$nomRole
                ]);
            }

    }

    #[Route('/ajoutVoiture', name: 'addVoiture')]

    public function addVoiture(RequestStack $requestStack, Request $request, EntityManagerInterface $em)
    {
        $voiture=new Voiture();

        $session = $requestStack->getSession();
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');

        $form=$this->createForm(VoitureType::class, $voiture);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
    
           $em ->persist($voiture);
           $voiture -> setCreerPar($nom." ".$prenom);
           $date = new \DateTime('@'.strtotime('now'));
           $voiture -> setCreerLe($date);
           $em ->flush();

           return $this->redirectToRoute('voiture');
  
        }
        return $this->render('voiture/addVoiture.html.twig',array(
            'form'=>$form->createView()

        ));
    }

    #[Route("/editVoiture/{id<\d+>}", name: "updateVoiture")]

    public function updateVoiture(RequestStack $requestStack, Request $request, Voiture $voiture, EntityManagerInterface $em)
    {
       
        $session = $requestStack->getSession();
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');
        
        $form=$this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

           $voiture -> setModifierPar($nom." ".$prenom);
           $date = new \DateTime('@'.strtotime('now'));
           $voiture -> setModifierLe($date);
           $em->flush();

           return $this->redirectToRoute('voiture');
  
        }

        return $this->render('voiture/updateVoiture.html.twig',array(
            'form'=>$form->createView()

        ));
    }

    #[Route("/deleteVoiture/{id<\d+>}", name : "deleteOneVoiture")]

    public function deleteVoiture(Voiture $voiture, EntityManagerInterface $em)
    {
          $em ->remove($voiture);
          $em ->flush();

          return $this->redirectToRoute('voiture');

       
    }

    #[Route("/refuserSupprimer")]

    public function refuserSupprimer()
    {
          return $this->redirectToRoute('voiture');

    }

    #[Route("/deletePage/{id<\d+>}")]

    public function deletePage(Voiture $voitures)
    {
        return $this->render('voiture/deleteVoiture.html.twig',array(

            'voitures'=>$voitures));

    }
}
