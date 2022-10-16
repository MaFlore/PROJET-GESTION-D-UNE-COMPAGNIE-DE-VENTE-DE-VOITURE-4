<?php

namespace App\Entity;

use App\Entity\Sauvegarde;
use App\Repository\VoitureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture extends Sauvegarde
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $marque;

    #[ORM\Column(type: 'string', length: 255)]
    private $modele;

    #[ORM\Column(type: 'string', length: 255)]
    private $numeroIdentifiant;

    #[ORM\Column(type: 'string', length: 255)]
    private $numeroSerie;

    #[ORM\Column(type: 'date')]
    private $dateAchat;

    #[ORM\Column(type: 'string', length: 255)]
    private $couleur;

    #[ORM\Column(type: 'boolean')]
    private $statut=false;

    #[ORM\OneToOne(mappedBy: 'voiture', targetEntity: Vente::class, cascade: ['persist', 'remove'])]
    private $Vente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getNumeroIdentifiant(): ?string
    {
        return $this->numeroIdentifiant;
    }

    public function setNumeroIdentifiant(string $numeroIdentifiant): self
    {
        $this->numeroIdentifiant = $numeroIdentifiant;

        return $this;
    }

    public function getNumeroSerie(): ?string
    {
        return $this->numeroSerie;
    }

    public function setNumeroSerie(string $numeroSerie): self
    {
        $this->numeroSerie = $numeroSerie;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getVente(): ?Vente
    {
        return $this->Vente;
    }

    public function setVente(Vente $Vente): self
    {
        // set the owning side of the relation if necessary
        if ($Vente->getVoiture() !== $this) {
            $Vente->setVoiture($this);
        }

        $this->Vente = $Vente;

        return $this;
    }

    /**
     * Get the value of statut
     */ 
    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    #[ORM\Column(type: 'string', length: 255)]
    private $creerPar;

    #[ORM\Column(type: 'datetime')]
    private $creerLe;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $modifierPar;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $modifierLe;

    #[ORM\Column(type: 'boolean')]
    private $enable = true;

    public function getCreerPar(): ?string
    {
        return $this->creerPar;
    }

    public function setCreerPar(string $creerPar): self
    {
        $this->creerPar = $creerPar;

        return $this;
    }

    public function getCreerLe(): ?\DateTimeInterface
    {
        return $this->creerLe;
    }

    public function setCreerLe(\DateTimeInterface $creerLe): self
    {
        $this->creerLe = $creerLe;

        return $this;
    }

    public function getModifierPar(): ?string
    {
        return $this->modifierPar;
    }

    public function setModifierPar(?string $modifierPar): self
    {
        $this->modifierPar = $modifierPar;

        return $this;
    }

    public function getModifierLe(): ?\DateTimeInterface
    {
        return $this->modifierLe;
    }

    public function setModifierLe(?\DateTimeInterface $modifierLe): self
    {
        $this->modifierLe = $modifierLe;

        return $this;
    }

    public function getEnable(): ?bool
    {
        return $this->enable;
    }

    public function setEnable(?bool $enable): self
    {
        $this->enable = $enable;

        return $this;
    }


}
