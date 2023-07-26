<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use App\Entity\Program;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BandRepository;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BandRepository::class)]

class Band
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
     private ?int $id;

    
    #[ORM\Column(length:255)]
    // #[Assert\NotBlank(message: 'Nom du groupe obligatoire')]
    // #[Assert\Length(min: 3, max: 255,
    // maxMessage: "Le nom du groupe saisi n'est pas valide, il ne doit pas dépasser {{ limit }} caractères",
    // minMessage: "Le nom du groupe saisi n'est pas valide, il ne doit pas être pas être inférieur à {{ limit }} caractères    "
    // )]
    private ?string $name = null;


    
    #[ORM\Column(length:255)]
    // #[Assert\NotBLank(message: 'Style de musique obligatoire')]
    // #[Assert\Length(min: 3, max: 255,
    // maxMessage: "Le style de musique saisi n'est pas valide, il ne doit pas dépasser {{ limit }} caractères",
    // minMessage: "Le style de musique saisi n'est pas valide, il ne doit pas être pas être inférieur à {{ limit }} caractères    "
    // )]
    private ?string $musical_style = null;


    #[ORM\Column(length:255)]
    // #[Assert\NotBlank(message: 'Photo du groupe obligatoire')]
    // #[Assert\Image(
    //     minWidth: 200,
    //     maxWidth: 400,
    //     minHeight: 200,
    //     maxHeight: 400,
    // )]
    private ?string $pictureName = null;


    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Description obligatoire')]
    private ?string $description = null;




    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    

    #[ORM\OneToMany(mappedBy: "program", targetEntity: Program::class)]
    private Collection $programs;

    public function __construct()
    {
        $this->programs = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMusicalStyle(): ?string
    {
        return $this->musical_style;
    }

    public function setMusicalStyle(string $musical_style): static
    {
        $this->musical_style = $musical_style;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }


    /**
     * @return Collection<int, Program>
     */
    public function getProgram(): Collection
    {
        return $this->programs;
    }

    

    public function addProgram(Program $programs): self
    {
        if (!$this->programs->contains($programs)) {
            $this->programs->add($programs);
            $programs->setBand($this);
        }

        return $this;

    }

    public function removeProgram(Program $programs): self
    {
        if ($this->programs->removeElement($programs)) {
            // set the owning side to null (unless already changed)
            if ($programs->getBand() === $this) {
                $programs->setBand(null);
            }
        }

        return $this;

    }
}
