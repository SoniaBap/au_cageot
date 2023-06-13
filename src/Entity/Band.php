<?php

namespace App\Entity;

use App\Repository\BandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BandRepository::class)]
class Band
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $musical_style = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Program::class, mappedBy: 'program_id')]
    private Collection $programs;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $user = null;

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

    public function setPicture(string $picture): static
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

    /**
     * @return Collection<int, Program>
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(Program $program): static
    {
        if (!$this->programs->contains($program)) {
            $this->programs->add($program);
            $program->addProgramId($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): static
    {
        if ($this->programs->removeElement($program)) {
            $program->removeProgramId($this);
        }

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user;
    }

    public function setUserId(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
