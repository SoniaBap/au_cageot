<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ProgramRepository::class)]
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    // #[Assert\NotBlank(message: 'Ville obligatoire')]
    // #[Assert\Length(max: 255, min: 3,
    // maxMessage: "La ville saisie {{ value }} n'est pas valide, elle ne doit pas dépasser {{ limit }} caractères",
    // minMessage: "La ville saisie {{ value }} n'est pas valide, elle ne doit pas être inférieure à {{ limit }} caractères"
    // )]
    private ?string $city = null;


    #[ORM\Column(length: 255)]
    // #[Assert\NotBlank(message: 'Nom du groupe obligatoire')]
    // #[Assert\Length(max: 255, min: 3,
    // maxMessage: "Le nom du groupe saisi {{ value }} n'est pas valide, il ne doit pas dépasser {{ limit }} caractères",
    // minMessage: "Le nom du groupe saisi {{ value }} n'est pas valide, il ne doit pas être pas être inférieur à {{ limit }} caractères    "
    // )]
    private ?string $name = null;


    #[ORM\Column(type: Types::TEXT)]
    // #[Assert\NotBlank(message: 'Description obligatoire')]
    private ?string $description = null;


    #[ORM\Column]
    // #[Assert\NotBlank(message: 'Date obligatoire')]

    private ?\DateTimeImmutable $created_at = null;




    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    // #[Assert\NotBlank(message: 'Date de réservation obligatoire')]

    private ?\DateTimeInterface $journey_of_reservation = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Band $band = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getJourneyOfReservation(): ?\DateTimeInterface
    {
        return $this->journey_of_reservation;
    }

    public function setJourneyOfReservation(\DateTimeInterface $journey_of_reservation): static
    {
        $this->journey_of_reservation = $journey_of_reservation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getBand(): ?Band
    {
        return $this->band;
    }

    public function setBand(?Band $band): static
    {
        $this->band = $band;

        return $this;
    }
}
