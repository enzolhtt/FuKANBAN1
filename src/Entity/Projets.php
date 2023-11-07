<?php

namespace App\Entity;

use App\Repository\ProjetsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetsRepository::class)]
class Projets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomProjet = null;

    #[ORM\Column(length: 255)]
    private ?string $DescriptionProjet = null;

    #[ORM\ManyToOne(inversedBy: 'projets')]
    private ?Utilisateurs $Createur = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateCreation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateModification = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProjet(): ?string
    {
        return $this->NomProjet;
    }

    public function setNomProjet(string $NomProjet): static
    {
        $this->NomProjet = $NomProjet;

        return $this;
    }

    public function getDescriptionProjet(): ?string
    {
        return $this->DescriptionProjet;
    }

    public function setDescriptionProjet(string $DescriptionProjet): static
    {
        $this->DescriptionProjet = $DescriptionProjet;

        return $this;
    }

    public function getCreateur(): ?Utilisateurs
    {
        return $this->Createur;
    }

    public function setCreateur(?Utilisateurs $Createur): static
    {
        $this->Createur = $Createur;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->DateCreation;
    }

    public function setDateCreation(\DateTimeInterface $DateCreation): static
    {
        $this->DateCreation = $DateCreation;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->DateModification;
    }

    public function setDateModification(\DateTimeInterface $DateModification): static
    {
        $this->DateModification = $DateModification;

        return $this;
    }

    public function __ToString(){
        return $this->NomProjet;
    }
}
