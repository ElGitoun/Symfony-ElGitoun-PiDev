<?php

namespace App\Entity;

use App\Repository\ReservationActiviteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationActiviteRepository::class)
 */
class ReservationActivite
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
    private $heureRA;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRA;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservationActivites")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Activite::class, inversedBy="reservationActivites")
     */
    private $activite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureRA(): ?string
    {
        return $this->heureRA;
    }

    public function setHeureRA(string $heureRA): self
    {
        $this->heureRA = $heureRA;

        return $this;
    }

    public function getDateRA(): ?\DateTimeInterface
    {
        return $this->dateRA;
    }

    public function setDateRA(\DateTimeInterface $dateRA): self
    {
        $this->dateRA = $dateRA;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getActivite(): ?Activite
    {
        return $this->activite;
    }

    public function setActivite(?Activite $activite): self
    {
        $this->activite = $activite;

        return $this;
    }
}
