<?php

namespace App\Entity;

use App\Entity\Role;
use App\Repository\PersonneRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Table(name:"Personne")]
#[ORM\Entity(repositoryClass: PersonneRepository::class)]
#[InheritanceType('JOINED')]
#[UniqueEntity(fields:"nomUtilisateur", message:"Ce nom d'utilisateur existe déjà dans la base de données")]

class Personne extends Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    protected $nom;

    #[ORM\Column(type: 'string', length: 255)]
    protected $prenom;

    #[ORM\Column(type: 'string', length: 255)]
    protected $telephone;

    #[ORM\Column(type: 'string', length: 255)]
    protected $nomUtilisateur;

    #[ORM\Column(type: 'string', length: 255)]
    protected $motDePasse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur(string $nomUtilisateur): self
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getMotDePasse(): string{
        return $this->motDePasse;
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
