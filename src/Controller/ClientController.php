<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    #[Route('/readClient/{id<\d+>}', name: 'ReadClient')]
    public function afficherClient(ClientRepository $clientRepository, Client $client, RequestStack $requestStack){

        $client=$clientRepository->find($client);

        $session = $requestStack->getSession();
        $nomUtilisateur=$session->get('nomUtilisateur');
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');
        $nomRole=$session->get('nomRole');

        if ($nomUtilisateur==null) {
            return $this->redirectToRoute("authentification");
        }

        return $this->render('client/afficheClient.html.twig', [

            'client'=>$client,
            'nom'=>$nom,
            'prenom'=>$prenom,
            'nomRole'=>$nomRole

        ]);


    }

    #[Route('/client', name: 'client')]
    public function allClient(RequestStack $requestStack,Request $request, ClientRepository $clientRepository){
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
                $selectrecherche = $request->get(key:'selectDate');
                $searchclient = $request->get(key:'searchclient');
                $client=$clientRepository->findBy(array($selectrecherche=>$searchclient));

                return $this->render('client/rechercheClient.html.twig',[

                    'clients'=>$client,
                    'nom'=>$nom,
                    'prenom' => $prenom,
                    'nomRole'=>$nomRole
        
                ]);
            }
            else{
                $clients=$clientRepository->findAll();

                return $this->render('client/listClient.html.twig', [

            'clients'=>$clients,
            'nom'=>$nom,
            'prenom' => $prenom,
            'nomRole' => $nomRole

                ]);
            }

    }

    #[Route('/ajoutClient', name: 'addClient')]

    public function addClient(RequestStack $requestStack, Request $request, EntityManagerInterface $em)
    {
        $client = new Client();
        
        $form=$this->createForm(ClientType::class, $client);

        $session = $requestStack->getSession();
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           //$hashdePassword = $passwordHasher->hashPassword($client, $client->getPassword());
           //$client -> setPassword($hashdePassword);
        
           $em ->persist($client);
           $client -> setNomRole("Client");
           $client -> setCreerPar($nom." ".$prenom);
           $date = new \DateTime('@'.strtotime('now'));
           $client -> setCreerLe($date);
           $em ->flush();

           return $this->redirectToRoute('client');
  
        }
        return $this->render('client/addClient.html.twig',array(
            'form'=>$form->createView(), 

        ));
    }

    #[Route("/editClient/{id<\d+>}", name: "updateClient")]

    public function updateClient(RequestStack $requestStack, Request $request, Client $client, EntityManagerInterface $em)
    {
       
        $session = $requestStack->getSession();
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');
        
        $form=$this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

           $client -> setModifierPar($nom." ".$prenom);
           $date = new \DateTime('@'.strtotime('now'));
           $client -> setModifierLe($date);
           $em->flush();

           return $this->redirectToRoute('client');
  
        }

        return $this->render('client/updateClient.html.twig',array(
            'form'=>$form->createView(),
            

        ));
    }

    #[Route("/deleteClient/{id<\d+>}", name : "deleteClient")]

    public function deleteClient(Request $request, Client $client, EntityManagerInterface $em)
    {
          $em ->remove($client);
          $em ->flush();

          return $this->redirectToRoute('client');

       
    }
    
}

