<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\UserRepository;
use App\State\UserPasswordHasher;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\Activatecount;
use ApiPlatform\Metadata\Link;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(
            processor: UserPasswordHasher::class,
        ),
        new Get(),
        new Patch(processor: UserPasswordHasher::class),
        new Delete(),
        new Put(
            uriTemplate: '/account/activate',
            controller: Activatecount::class,
            name: 'user_active',
            denormalizationContext: ['groups' => ['user:active']],

        )
        // new Post(
        //     uriTemplate: '/register',
        //     controller: UserActive::class,
        //     name: 'register',
        // ),
        // new Post(
        //     path: '/users/active/{id}',
        //     controller: 'App\Controller\UserActive',
        //     normalizationContext: ['groups' => ['user:read']],
        //     denormalizationContext: ['groups' => ['user:active']],
        // ),
    ],
    // normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user_write', 'user:update']],
)]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[Groups(['user_write', 'user:update'])]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[Groups(['user_write', 'user:update'])]
    #[ORM\Column]
    private ?string $password = null;

    #[Assert\NotBlank(groups: ['user_write'])]
    #[Groups(['user_write', 'user:update'])]
    private ?string $plainPassword = null;

    #[Groups(['user:active'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    #[Groups(['user_write', 'user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[Groups(['user_write', 'user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[Groups(['user_write', 'user:update'])]
    #[ORM\Column(type: 'boolean', nullable: true, options: ['default' => false])]
    private ?bool $is_Active = false;

    #[Groups(['user_write', 'user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[Groups(['user_write', 'user:update'])]
    #[ORM\Column]
    private ?int $postalcode = null;

    #[Groups(['user_write', 'user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[Groups(['user_write', 'user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $country = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $painPassword): self
    {
        $this->plainPassword = $painPassword;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }


    public function isIsActive(): ?bool
    {
        return $this->is_Active;
    }

    public function setIsActive(bool $is_Active): self
    {
        $this->is_Active = $is_Active;
        return $this;
    }
    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalcode(): ?int
    {
        return $this->postalcode;
    }

    public function setPostalcode(int $postalcode): self
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }
}
