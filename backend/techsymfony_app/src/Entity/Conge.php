<?php

namespace App\Entity;

use App\Repository\CongeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CongeRepository::class)]
class Conge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_debut_con = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin_con = null;

    #[ORM\Column]
    private ?int $duree_conge = null;

    #[ORM\ManyToOne(inversedBy: 'conges')]
    private ?User $User = null;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebutCon(): ?\DateTimeInterface
    {
        return $this->date_debut_con;
    }

    public function setDateDebutCon(\DateTimeInterface $date_debut_con): static
    {
        $this->date_debut_con = $date_debut_con;

        return $this;
    }

    public function getDateFinCon(): ?\DateTimeInterface
    {
        return $this->date_fin_con;
    }

    public function setDateFinCon(\DateTimeInterface $date_fin_con): static
    {
        $this->date_fin_con = $date_fin_con;

        return $this;
    }

    public function getDureeConge(): ?int
    {
        return $this->duree_conge;
    }

    public function setDureeConge(int $duree_conge): static
    {
        $this->duree_conge = $duree_conge;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

}
