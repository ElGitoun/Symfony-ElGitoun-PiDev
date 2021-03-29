<?php

namespace App\Entity;

use App\Repository\CategorieEquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieEquipementRepository::class)
 */
class CategorieEquipement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=PublicationEquipement::class, mappedBy="categorie")
     */
    private $publicationEquipements;

    public function __construct()
    {
        $this->publicationEquipements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|PublicationEquipement[]
     */
    public function getPublicationEquipements(): Collection
    {
        return $this->publicationEquipements;
    }

    public function addPublicationEquipement(PublicationEquipement $publicationEquipement): self
    {
        if (!$this->publicationEquipements->contains($publicationEquipement)) {
            $this->publicationEquipements[] = $publicationEquipement;
            $publicationEquipement->setCategorie($this);
        }

        return $this;
    }

    public function removePublicationEquipement(PublicationEquipement $publicationEquipement): self
    {
        if ($this->publicationEquipements->removeElement($publicationEquipement)) {
            // set the owning side to null (unless already changed)
            if ($publicationEquipement->getCategorie() === $this) {
                $publicationEquipement->setCategorie(null);
            }
        }

        return $this;
    }
}
