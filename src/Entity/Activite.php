<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ActiviteRepository::class)
 * @Vich\Uploadable()
 */
class Activite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Vich\UploadableField(mapping="activite_image", fileNameProperty="fileName")
     * 
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string" , length=255)
     *
     * @var string|null
     */
    private $fileName;

    /**
     * @Assert\NotNull
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Assert\NotNull
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Assert\NotNull
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @Assert\NotNull
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     
     * @Assert\Range(min = 2,max = 12 )
     
     * @ORM\Column(type="string", length=255)
     */
    private $duration;

    /**
     * @Assert\Range(min = 45,max = 110 )
     * @Assert\NotNull
     * @ORM\Column(type="integer")
     */
    private $size;
    
    /**
     
     * @ORM\OneToMany(targetEntity=ReservationActivite::class, mappedBy="activite")
     */
    private $reservationActivites;

    /**
     * @Assert\NotNull
     * @ORM\Column(type="string", length=255)
     */
    private $emplacement;

    /**
     
     * @ORM\ManyToOne(targetEntity=TypeActivite::class, inversedBy="activites")
     */
    private $typeActivite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;
   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getTypeActivite(): ?TypeActivite
    {
        return $this->typeActivite;
    }

    public function setTypeActivite(?TypeActivite $typeActivite): self
    {
        $this->typeActivite = $typeActivite;

        return $this;
    }

    

    /**
     * Get the value of imageFile
     *
     * @return  File|null
     */ 
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @param  File|null  $imageFile
     *
     * @return  Activite
     */ 
    public function setImageFile(?File $imageFile): Activite
    {
        $this->imageFile = $imageFile;
        
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    /**
     * Get the value of fileName
     *
     * @return  string|null
     */ 
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * Set the value of fileName
     *
     * @param  string|null  $fileName
     *
     * @return  Activite
     */ 
    public function setFileName(?string $fileName): Activite
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}

