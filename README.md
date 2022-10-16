# PROJET-GESTION-D-UNE-COMPAGNIE-DE-VENTE-DE-VOITURE-4
PROJET : Gestion d’une compagnie de ventes de voitures Le projet consistera principalement à la gestion des activités d’une compagnie de ventes de  voitures. 
Le projet prendra en compte :  
        • La gestion des voitures ; 
        • La gestion des clients ; 
        • La gestion des ventes des voitures.

TRAVAIL A FAIRE :
  1. Mise à jour du projet Symfony créé dans le TP 3 ;
  2. Implémentation de la gestion des utilisateurs : 
        • Création de compte ;
            Vous allez ajouter une nouvelle classe « Role » permettant de savoir si une 
            personne est un client, un gérant ou un administrateur (responsable de la 
            compagnie). Vous allez la relier à la classe « Personne ». Lors de l’ajout d’un 
            utilisateur, vous devez lui associer son rôle.
            Lors de l’ajout d’un client par un gérant ou l’administrateur, s’il passe par le 
            menu « Client », il ne doit pas choisir le rôle « Client » au niveau de l’interface 
            mais le rôle doit être automatiquement renseigné au niveau du contrôleur. Même 
            analogie si possible avec les autres.
            Si une même interface sera utilisée pour ajouter plusieurs types de personnes 
            par un même utilisateur, le rôle doit donc être choisi au niveau de l’interface.
        • Authentification (« manuellement » sans l’utilisation de Security Bundle) ;
            Après l’authentification réussie, l’utilisateur doit être redirigé vers son espace.
        • Ajout d’une nouvelle classe dont hérite toutes les autres classes ayant les 
            attributs suivants : creerLe, creerPar, modifierLe, modifierPar, statut.
            La nouvelle classe n’aura pas de correspondance de table en base de données.
            Lors de l’insertion d’une nouvelle occurrence dans les tables, il faudra renseigner 
            les attributs creerLe, creerPar et mettre le statut à True.
            Lors de la modification d’une occurrence dans les tables, il faut mettre à jour 
            modifierLe et modifierPar.
Comme expliqué au cours.

Version PHP : 8
Version SYMFONY : 6
