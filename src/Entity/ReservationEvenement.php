<?php

namespace App\Entity;

use App\Repository\ReservationEvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationEvenementRepository::class)
 */
class ReservationEvenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $heureR;

    /**
     * @ORM\Column(type="date")
     */
    private $dateR;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="reservationEvenements")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Evenement::class, inversedBy="reservationEvenements")
     */
    private $evenement;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureR(): ?\DateTimeInterface
    {
        return $this->heureR;
    }

    public function setHeureR(\DateTimeInterface $heureR): self
    {
        $this->heureR = $heureR;

        return $this;
    }

    public function getDateR(): ?\DateTimeInterface
    {
        return $this->dateR;
    }

    public function setDateR(\DateTimeInterface $dateR): self
    {
        $this->dateR = $dateR;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }

}
