<?php

namespace App\Entity;

use App\Repository\PublicationEquipementRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



/**
 * @ORM\Entity(repositoryClass=PublicationEquipementRepository::class)
 * @Vich\Uploadable
 */
class PublicationEquipement
{
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Type("string")
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     * )
     *@Assert\NotNull(message="please type a title for your product" )
     *Type("string")
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * 
     *Type("string")
     * @Assert\Length(
     *      min = 8,
     *      max = 1000,
     *       
     * )
     *@Assert\NotNull(message="please type a discription for your product")  
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @Assert\Regex("/^[0-9]/")
     * @Assert\NotNull(message="please type a price for your product") 
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;
    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     * @var string|null
     */
    private $filename;
    /**
     * @Assert\NotNull(message="please select an image")
     * @var File
     * @Vich\UploadableField(mapping="products_image",fileNameProperty="filename")
     */
    private $imageFile;
    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="publicationEquipements")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=TypePublication::class, inversedBy="publicationEquipements")
     */
    private $typePublication;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;
    public  function __construct()
    {
        $this->created_at=new DateTime();
        $this->updated_at=new DateTime();


        
    }

    /**
     * @ORM\Column(type="boolean",options={"default":false})
     */
    private $visible=false;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieEquipement::class, inversedBy="publicationEquipements")
     */
    private $categorie;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
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

    

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTypePublication():?TypePublication
    {
        return $this->typePublication;
    }

    public function setTypePublication(?TypePublication $typePublication): self
    {
        $this->typePublication = $typePublication;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getCategorie(): ?CategorieEquipement
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieEquipement $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return PublicationEquipement
     */
    public function setFilename(?string $filename): PublicationEquipement
    {
        $this->filename = $filename;
       
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return PublicationEquipement
     */
    public function setImageFile(?File $imageFile): PublicationEquipement
    {
        $this->imageFile = $imageFile;
        
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
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
