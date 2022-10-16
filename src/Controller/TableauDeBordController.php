<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;
use App\Repository\VenteRepository;
use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class TableauDeBordController extends AbstractController
{
    #[Route('/tableau_de_bord', name: 'tableau_de_bord')]
    public function index(RequestStack $requestStack , VoitureRepository $voitureRepository, VenteRepository $venteRepository,ClientRepository $clientRepository): Response
    {
        $voitures = $voitureRepository->findAll();
        $resultatVoiture = count($voitures);
        $ventes = $venteRepository->findAll();
        $resultatVente = count($ventes);
        $clients = $clientRepository ->findAll();
        $resultatClient = count(($clients));
        
        $session = $requestStack->getSession();
        $nomUtilisateur=$session->get('nomUtilisateur');
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');
        $nomRole=$session->get('nomRole');
        if ($nomUtilisateur==null) {
            return $this->redirectToRoute("authentification");
        }

        return $this->render('tableau_de_bord/index.html.twig', [
            'controller_name' => 'TableauDeBordController',
            'resultatVoiture' => $resultatVoiture,
            'resultatVente' => $resultatVente,
            'resultatClient'=> $resultatClient,
            'nom' => $nom,
            'prenom' => $prenom,
            'nomRole'=>$nomRole
        ]);
    }

}
