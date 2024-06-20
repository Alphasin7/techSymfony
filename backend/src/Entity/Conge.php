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

    #[ORM\Column(length: 255)]
    private ?string $reason = null;

    #[ORM\Column(length: 15)]
    private ?string $progress = null;

    #[ORM\Column(length: 255)]
    private ?string $department = null;

    #[ORM\Column(length: 255)]
    private ?string $fullname = null;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebutCon():string
    {
        return $this->date_debut_con->format("Y-m-d");
    }

    public function setDateDebutCon(\DateTimeInterface $date_debut_con): static
    {
        $this->date_debut_con = $date_debut_con;

        return $this;
    }

    public function getDateFinCon():string
    {
        return $this->date_fin_con->format("Y-m-d");
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

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): static
    {
        $this->reason = $reason;

        return $this;
    }

    public function getProgress(): ?string
    {
        return $this->progress;
    }

    public function setProgress(string $progress): static
    {
        $this->progress = $progress;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(string $department): static
    {
        $this->department = $department;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): static
    {
        $this->fullname = $fullname;

        return $this;
    }

}
