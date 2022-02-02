<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\AnimauxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimauxRepository::class)]
class Animaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[ORM\Column(type: 'string', length: 50)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $race;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isCanivore;

    #[Assert\Positive(message: "Le nombre de pattes doit etre positif.")]
    #[ORM\Column(type: 'integer')]
    private $nbpattes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getIsCanivore(): ?bool
    {
        return $this->isCanivore;
    }

    public function setIsCanivore(?bool $isCanivore): self
    {
        $this->isCanivore = $isCanivore;

        return $this;
    }

    public function getNbpattes(): ?int
    {
        return $this->nbpattes;
    }

    public function setNbpattes(int $nbpattes): self
    {
        $this->nbpattes = $nbpattes;

        return $this;
    }
}
