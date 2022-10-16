<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Sauvegarde
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $creerPar;

    #[ORM\Column(type: 'datetime')]
    private $creerLe;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $modifierPar;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $modifierLe;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $enable;

    public function getId(): ?int
    {
        return $this->id;
    }

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
