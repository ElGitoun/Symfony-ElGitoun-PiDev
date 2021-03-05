<?php

namespace App\Entity;

use App\Repository\ForumCommentaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ForumCommentaireRepository::class)
 */
class ForumCommentaire
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
    private $date;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $reaction;

    /**
     * @ORM\OneToMany(targetEntity=PublicationForum::class, mappedBy="commentaire")
     */
    private $publicationForums;

    /**
     * @ORM\ManyToOne(targetEntity=PublicationForum::class, inversedBy="forumCommentaires")
     */
    private $publication;

    public function __construct()
    {
        $this->publicationForums = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getReaction(): ?int
    {
        return $this->reaction;
    }

    public function setReaction(int $reaction): self
    {
        $this->reaction = $reaction;

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
            $publicationForum->setCommentaire($this);
        }

        return $this;
    }

    public function removePublicationForum(PublicationForum $publicationForum): self
    {
        if ($this->publicationForums->removeElement($publicationForum)) {
            // set the owning side to null (unless already changed)
            if ($publicationForum->getCommentaire() === $this) {
                $publicationForum->setCommentaire(null);
            }
        }

        return $this;
    }

    public function getPublication(): ?PublicationForum
    {
        return $this->publication;
    }

    public function setPublication(?PublicationForum $publication): self
    {
        $this->publication = $publication;

        return $this;
    }
}
