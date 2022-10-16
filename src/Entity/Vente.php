<?php

namespace App\Entity;

use App\Entity\Sauvegarde;
use App\Entity\Voiture;
use App\Entity\Client;
use App\Repository\VenteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VenteRepository::class)]
class Vente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'date')]
    private $dateVente;

    #[ORM\Column(type: 'integer')]
    private $montant;

    #[ORM\OneToOne(inversedBy: 'Vente', targetEntity: Voiture::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private $voiture;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'ventes')]
    #[ORM\JoinColumn(nullable: true)]
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateVente(): ?\DateTimeInterface
    {
        return $this->dateVente;
    }

    public function setDateVente(\DateTimeInterface $dateVente): self
    {
        $this->dateVente = $dateVente;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(Voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

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
