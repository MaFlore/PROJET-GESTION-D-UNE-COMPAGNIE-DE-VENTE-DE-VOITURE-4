<?php

namespace App\Controller;

use App\Entity\Administrateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;
use App\Form\PersonneType;
use App\Repository\PersonneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class AuthentificationController extends AbstractController
{
    #[Route('/', name: 'authentification')]
    public function index(Request $request, PersonneRepository $personneRepository, RequestStack $requestStack): Response
    {

        //$error = $authenticationUtils->getLastAuthenticationError();
        //$last_username = $authenticationUtils->getLastUsername();

        //return $this->render('security/index.html.twig',[
            //'controller_name' => 'AuthentificationController',
            //'error'=>$error,
            //'last_username'=>$last_username
        //]);
        if($request->request->get('username')!=null ){
            $username= $request->request->get('username');
            $password= $request->request->get('password');
            $personne=new Personne();
            $personne=$personneRepository->findOneBy([
                'nomUtilisateur'=>$username,
                'motDePasse'=>$password
            ]);
            if($personne!=null && $personne->getId()>0){
                $session = $requestStack->getSession();
                $session->set('nom', $personne->getNom());
                $session->set('prenom', $personne->getPrenom());
                $session->set('nomUtilisateur', $personne->getNomUtilisateur());
                $session->set('nomRole', $personne->getNomRole());
                
                //$foo = $session->get('foo');

                // the second argument is the value returned when the attribute doesn't exist
                //$filters = $session->get('filters', []);
                return $this->redirectToRoute('tableau_de_bord');
            }

        }
        return $this->render('authentification/index.html.twig', [
            'controller_name' => 'AuthentificationController'
        ]);
    }

    #[Route('/deconnexion', name: 'deconnexion')]
    public function seDeconnecter(RequestStack $requestStack)
    {
        $session = $requestStack->getSession();
        $session->set('nom', null);
        $session->set('prenom', null);
        $session->set('nomUtilisateur', null);
        return $this->redirectToRoute('tableau_de_bord');
    }

    #[Route('/inscription', name: 'inscription')]
    public function creerCompte(Request $request, EntityManagerInterface $em)
    {
        $administrateur = new Administrateur();
        $form=$this->createForm(PersonneType::class, $administrateur);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){ 
           //$personne -> setPassword($passwordHasher->hashPassword($personne, $personne->getPassword()));
           $em ->persist($administrateur);
           $administrateur->setNomRole("Administrateur");
           $administrateur->setCreerPar("");
           $date = new \DateTime('@'.strtotime('now'));
           $administrateur->setCreerLe($date);
           $em ->flush();

           return $this->redirectToRoute('authentification');
  
        }
        return $this->render('authentification/inscription.html.twig',array(
            'form'=>$form->createView(), 

        ));
    }
    
}
