<?php

namespace App\Entity;

use App\Repository\ConsommableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsommableRepository::class)]
class Consommable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(type: Types::BLOB)]
    private $image = null;





    #[ORM\ManyToMany(targetEntity: Equipement::class, mappedBy: 'Equipement_Consommable')]
    private Collection $equipements;

    #[ORM\ManyToOne(inversedBy: 'consommables')]
    private ?LigneCommande $LigneCommande = null;



    public function __construct()
    {

        $this->ligneCommandes = new ArrayCollection();
        $this->equipements = new ArrayCollection();
        $this->Consommable_Equipement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): static
    {
        $this->image = $image;

        return $this;
    }



    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->addEquipementConsommable($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            $equipement->removeEquipementConsommable($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getConsommableEquipement(): Collection
    {
        return $this->Consommable_Equipement;
    }

    public function addConsommableEquipement(Equipement $consommableEquipement): static
    {
        if (!$this->Consommable_Equipement->contains($consommableEquipement)) {
            $this->Consommable_Equipement->add($consommableEquipement);
        }

        return $this;
    }

    public function removeConsommableEquipement(Equipement $consommableEquipement): static
    {
        $this->Consommable_Equipement->removeElement($consommableEquipement);

        return $this;
    }

    public function __toString(): string
    {
        return $this->label;
    }

    public function getLigneCommande(): ?LigneCommande
    {
        return $this->LigneCommande;
    }

    public function setLigneCommande(?LigneCommande $LigneCommande): static
    {
        $this->LigneCommande = $LigneCommande;

        return $this;
    }

}
