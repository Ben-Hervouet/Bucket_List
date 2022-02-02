<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $Trave_Aventure;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $Sport;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $Entrainement;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $Humain_Rrelations;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $Others;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Wish::class)]
    private $wishes;

    public function __construct()
    {
        $this->wishes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTraveAventure(): ?string
    {
        return $this->Trave_Aventure;
    }

    public function setTraveAventure(?string $Trave_Aventure): self
    {
        $this->Trave_Aventure = $Trave_Aventure;

        return $this;
    }

    public function getSport(): ?string
    {
        return $this->Sport;
    }

    public function setSport(?string $Sport): self
    {
        $this->Sport = $Sport;

        return $this;
    }

    public function getEntrainement(): ?string
    {
        return $this->Entrainement;
    }

    public function setEntrainement(?string $Entrainement): self
    {
        $this->Entrainement = $Entrainement;

        return $this;
    }

    public function getHumainRrelations(): ?string
    {
        return $this->Humain_Rrelations;
    }

    public function setHumainRrelations(?string $Humain_Rrelations): self
    {
        $this->Humain_Rrelations = $Humain_Rrelations;

        return $this;
    }

    public function getOthers(): ?string
    {
        return $this->Others;
    }

    public function setOthers(?string $Others): self
    {
        $this->Others = $Others;

        return $this;
    }

    /**
     * @return Collection|Wish[]
     */
    public function getWishes(): Collection
    {
        return $this->wishes;
    }

    public function addWish(Wish $wish): self
    {
        if (!$this->wishes->contains($wish)) {
            $this->wishes[] = $wish;
            $wish->setCategory($this);
        }

        return $this;
    }

    public function removeWish(Wish $wish): self
    {
        if ($this->wishes->removeElement($wish)) {
            // set the owning side to null (unless already changed)
            if ($wish->getCategory() === $this) {
                $wish->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
         return $this->getOthers();;
        // TODO: Implement __toString() method.
    }

}
