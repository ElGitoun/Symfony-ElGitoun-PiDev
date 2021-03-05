<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birth_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity=ReservationEvenement::class, mappedBy="utilisateur")
     */
    private $reservationEvenements;

    /**
     * @ORM\OneToMany(targetEntity=ReservationActivite::class, mappedBy="user")
     */
    private $reservationActivites;

    /**
     * @ORM\OneToMany(targetEntity=PublicationForum::class, mappedBy="user")
     */
    private $publicationForums;

    /**
     * @ORM\OneToMany(targetEntity=PublicationEquipement::class, mappedBy="user")
     */
    private $publicationEquipements;

    /**
     * @ORM\OneToMany(targetEntity=Feedback::class, mappedBy="user")
     */
    private $feedback;

    public function __construct()
    {
        $this->reservationEvenements = new ArrayCollection();
        $this->reservationActivites = new ArrayCollection();
        $this->publicationForums = new ArrayCollection();
        $this->publicationEquipements = new ArrayCollection();
        $this->feedback = new ArrayCollection();
    }

   
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(?\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getRole(): ?bool
    {
        return $this->role;
    }

    public function setRole(bool $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|ReservationEvenement[]
     */
    public function getReservationEvenements(): Collection
    {
        return $this->reservationEvenements;
    }

    public function addReservationEvenement(ReservationEvenement $reservationEvenement): self
    {
        if (!$this->reservationEvenements->contains($reservationEvenement)) {
            $this->reservationEvenements[] = $reservationEvenement;
            $reservationEvenement->setUtilisateur($this);
        }

        return $this;
    }

    public function removeReservationEvenement(ReservationEvenement $reservationEvenement): self
    {
        if ($this->reservationEvenements->removeElement($reservationEvenement)) {
            // set the owning side to null (unless already changed)
            if ($reservationEvenement->getUtilisateur() === $this) {
                $reservationEvenement->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ReservationActivite[]
     */
    public function getReservationActivites(): Collection
    {
        return $this->reservationActivites;
    }

    public function addReservationActivite(ReservationActivite $reservationActivite): self
    {
        if (!$this->reservationActivites->contains($reservationActivite)) {
            $this->reservationActivites[] = $reservationActivite;
            $reservationActivite->setUser($this);
        }

        return $this;
    }

    public function removeReservationActivite(ReservationActivite $reservationActivite): self
    {
        if ($this->reservationActivites->removeElement($reservationActivite)) {
            // set the owning side to null (unless already changed)
            if ($reservationActivite->getUser() === $this) {
                $reservationActivite->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PublicationForum[]
     */
    public function getPublicationForums(): Collection
    {
        return $this->publicationForums;
    }

    public function addPublicationForum(PublicationForum $publicationForum): self
    {
        if (!$this->publicationForums->contains($publicationForum)) {
            $this->publicationForums[] = $publicationForum;
            $publicationForum->setUser($this);
        }

        return $this;
    }

    public function removePublicationForum(PublicationForum $publicationForum): self
    {
        if ($this->publicationForums->removeElement($publicationForum)) {
            // set the owning side to null (unless already changed)
            if ($publicationForum->getUser() === $this) {
                $publicationForum->setUser(null);
            }
        }

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
            $publicationEquipement->setUser($this);
        }

        return $this;
    }

    public function removePublicationEquipement(PublicationEquipement $publicationEquipement): self
    {
        if ($this->publicationEquipements->removeElement($publicationEquipement)) {
            // set the owning side to null (unless already changed)
            if ($publicationEquipement->getUser() === $this) {
                $publicationEquipement->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Feedback[]
     */
    public function getFeedback(): Collection
    {
        return $this->feedback;
    }

    public function addFeedback(Feedback $feedback): self
    {
        if (!$this->feedback->contains($feedback)) {
            $this->feedback[] = $feedback;
            $feedback->setUser($this);
        }

        return $this;
    }

    public function removeFeedback(Feedback $feedback): self
    {
        if ($this->feedback->removeElement($feedback)) {
            // set the owning side to null (unless already changed)
            if ($feedback->getUser() === $this) {
                $feedback->setUser(null);
            }
        }

        return $this;
    }

   

}
