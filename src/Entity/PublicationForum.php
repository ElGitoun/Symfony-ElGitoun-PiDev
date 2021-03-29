<?php

namespace App\Entity;

use App\Repository\PublicationForumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;








/**
 * @ORM\Entity(repositoryClass=PublicationForumRepository::class)
 */
class PublicationForum
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotNull

     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
      * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="publicationForums")
     */
    private $user;



/*
    /**
     * @ORM\OneToMany(targetEntity=ForumCommentaire::class, mappedBy="publicationForums")
     */
   /* private $forumCommentaires;*/

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $views;

    /**
     * @ORM\OneToMany(targetEntity=ForumCommentaire::class, mappedBy="publicationForums")
     */
    private $cmts;

    public function __construct()
    {
        $this->cmts = new ArrayCollection();
    }

   /* public function __construct()
    {
        $this->forumCommentaires = new ArrayCollection();
    }*/


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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
/*
    /**
     * @return Collection|ForumCommentaire[]
     */
   /* public function getForumCommentaires(): Collection
    {
        return $this->forumCommentaires;
    }

    public function addForumCommentaire(ForumCommentaire $forumCommentaire): self
    {
        if (!$this->forumCommentaires->contains($forumCommentaire)) {
            $this->forumCommentaires[] = $forumCommentaire;
            $forumCommentaire->setPublication($this);
        }

        return $this;
    }

    public function removeForumCommentaire(ForumCommentaire $forumCommentaire): self
    {
        if ($this->forumCommentaires->removeElement($forumCommentaire)) {
            // set the owning side to null (unless already changed)
            if ($forumCommentaire->getPublication() === $this) {
                $forumCommentaire->setPublication(null);
            }
        }

        return $this;
    }*/
/*
    public function getComment(): ?string
    {
        return $this->Comment;
    }

    public function setComment(?string $Comment): self
    {
        $this->Comment = $Comment;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->Comments;
    }

    public function setComments(string $Comments): self
    {
        $this->Comments = $Comments;

        return $this;
    }
*/

public function getViews(): ?int
{
    return $this->views;
}

public function setViews(?int $views): self
{
    $this->views = $views;

    return $this;
}

/**
 * @return Collection|ForumCommentaire[]
 */
public function getCmts(): Collection
{
    return $this->cmts;
}

public function addCmt(ForumCommentaire $cmt): self
{
    if (!$this->cmts->contains($cmt)) {
        $this->cmts[] = $cmt;
        $cmt->setPublicationForums($this);
    }

    return $this;
}

public function removeCmt(ForumCommentaire $cmt): self
{
    if ($this->cmts->removeElement($cmt)) {
        // set the owning side to null (unless already changed)
        if ($cmt->getPublicationForums() === $this) {
            $cmt->setPublicationForums(null);
        }
    }

    return $this;
}
   
}
