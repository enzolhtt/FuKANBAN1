<?php

namespace App\Entity;

use App\Repository\TachesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TachesRepository::class)]
class Taches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $TitreTache = null;

    #[ORM\Column(length: 255)]
    private ?string $DescriptionTache = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    private ?Statut $Statut = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    private ?Projets $Projet = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    private ?Utilisateurs $Utilisateur = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateCreation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateEcheance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreTache(): ?string
    {
        return $this->TitreTache;
    }

    public function setTitreTache(string $TitreTache): static
    {
        $this->TitreTache = $TitreTache;

        return $this;
    }

    public function getDescriptionTache(): ?string
    {
        return $this->DescriptionTache;
    }

    public function setDescriptionTache(string $DescriptionTache): static
    {
        $this->DescriptionTache = $DescriptionTache;

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->Statut;
    }

    public function setStatut(?Statut $Statut): static
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getProjet(): ?Projets
    {
        return $this->Projet;
    }

    public function setProjet(?Projets $Projet): static
    {
        $this->Projet = $Projet;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateurs
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?Utilisateurs $Utilisateur): static
    {
        $this->Utilisateur = $Utilisateur;

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

    public function getDateEcheance(): ?\DateTimeInterface
    {
        return $this->DateEcheance;
    }

    public function setDateEcheance(\DateTimeInterface $DateEcheance): static
    {
        $this->DateEcheance = $DateEcheance;

        return $this;
    }
}
