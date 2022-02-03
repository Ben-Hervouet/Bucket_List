<?php

namespace App\Entity;

use App\Repository\WishRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable
 *
 */
#[ORM\Entity(repositoryClass: WishRepository::class)]

class Wish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 250)]
    private $title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[ORM\Column(type: 'string', length: 50)]
    private $author;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isPublished;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateCreated;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'wishes')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nomImage;

    /**
     * @Vich\UploadableField(mapping="wish_image", fileNameProperty="nomImage")
     * @param File|UploadedFile|null $fichierImage
     */
    private $fichierImage;



    public function __construct(){
        $this->dateCreated = new \DateTime();
    }

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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(?bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(?\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getNomImage(): ?string
    {
        return $this->nomImage;
    }

    public function setNomImage(?string $nomImage): self
    {
        $this->nomImage = $nomImage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFichierImage()
    {
        return $this->fichierImage;
    }

        public function setFichierImage(?File $fichierImage): self
    {
        $this->fichierImage = $fichierImage;

        return $this;

    }

}
