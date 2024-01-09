<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\EntityListener\UserListener;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity("email")]
#[ORM\EntityListeners([UserListener::class])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private ?int $id;

  #[ORM\Column(type: 'string', length: 255, unique: true)]
  //  #[Assert\NotBlank(message: 'Email obligatoire')]
  // #[Assert\Email(message: "Votre email {{ value }} n'est pas valide.")]
  private ?string $email;

  #[ORM\Column(type: 'json')]
  private array $roles = [];

  /**
   * @var string The hashed password
   */
  #[ORM\Column(type: 'string', length: 255)]
  // #[Assert\NotBlank(message: 'Mot de passe obligatoire')]
  // #[UserPassword(message: "Votre mot de passe n'est pas valide.")]
  private ?string $password;
  private ?string $plainPassword = null;

  #[ORM\Column(type: 'string', length: 255)]
  // #[Assert\NotBlank(message: 'Prénom obligatoire')]
  // #[Assert\Length(min: 3, max: 255,
  // maxMessage: "Le prénom saisi n'est pas valide, il ne doit pas dépasser {{ limit }} caractères",
  // minMessage: "Le prénom saisi n'est pas valide, il ne doit pas être pas être inférieur à {{ limit }} caractères    "
  // )]
  private ?string $firstname;

  #[ORM\Column(type: 'string', length: 255)]
  // #[Assert\NotBlank(message: 'Nom obligatoire')]
  // #[Assert\Length(min: 3 , max: 255, 
  // maxMessage: "Le nom saisi n'est pas valide, il ne doit pas dépasser {{ limit }} caractères",
  // minMessage: "Le nom saisi n'est pas valide, il ne doit pas être pas être inférieur à {{ limit }} caractères    "
  // )]
  private ?string $lastname;

  #[ORM\Column(type: 'string', length: 255, nullable: true)]
  // #[Assert\Length(min: 3 , max: 255,
  // maxMessage: "Le pseudo saisi n'est pas valide, il ne doit pas dépasser {{ limit }} caractères",
  // minMessage: "Le nom saisi n'est pas valide, il ne doit pas être pas être inférieur à {{ limit }} caractères    "
  // )]
  private ?string $nickname;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(string $email): static
  {
    $this->email = $email;

    return $this;
  }

  /**
   * A visual identifier that represents this user.
   *
   * @see UserInterface
   */
  public function getUserIdentifier(): string
  {
    return (string) $this->email;
  }

  /**
   * @see UserInterface
   */
  public function getRoles(): array
  {
    $roles = $this->roles;
    // guarantee every user at least has ROLE_USER
    $roles[] = 'ROLE_USER';

    return array_unique($roles);
  }

  public function setRoles(array $roles): static
  {
    $this->roles = $roles;

    return $this;
  }

  /**
   * @see PasswordAuthenticatedUserInterface
   */
  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password): static
  {
    $this->password = $password;

    return $this;
  }
  public function getPlainPassword(): string
  {
    return $this->plainPassword;
  }

  public function setPlainPassword(string $plainPassword): self
  {
    $this->plainPassword = $plainPassword;

    return $this;
  }

  public function getFirstname(): ?string
  {
    return $this->firstname;
  }

  public function setFirstname(string $firstname): static
  {
    $this->firstname = $firstname;

    return $this;
  }

  public function getLastname(): ?string
  {
    return $this->lastname;
  }

  public function setLastname(string $lastname): static
  {
    $this->lastname = $lastname;

    return $this;
  }

  public function getNickname(): ?string
  {
    return $this->nickname;
  }

  public function setNickname(?string $nickname): static
  {
    $this->nickname = $nickname;

    return $this;
  }

  /**
   * @see UserInterface
   */
  public function eraseCredentials(): void
  {
    //$this->plainPassword = null;
  }
}
