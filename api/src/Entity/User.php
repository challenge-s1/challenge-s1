<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\ResetPasswordController;
use App\Controller\UpdatePasswordController;
use App\Repository\UserRepository;
use App\State\UserPasswordHasher;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
        new Put(processor: UserPasswordHasher::class),
        new Post(
            name: 'reset_password',
            uriTemplate: '/users/reset-password',
            controller: ResetPasswordController::class,
            denormalizationContext: ['groups' => ['user:reset-password']],
        ),
        new Post(
            // processor: UserPasswordHasher::class,
            name: 'update_password',
            uriTemplate: '/users/update-password',
            controller: UpdatePasswordController::class,
            denormalizationContext: ['groups' => ['user:update-password']],

        ),
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
    // denormalizationContext: ['groups' => ['user:create', 'user:update']],

)]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[Groups(['user_write', 'user:update', 'user:reset-password'])]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    /**
     * @var string The hashed password
     */


    #[Groups(['user_write', 'user:update', 'user:update-password'])]
    #[ORM\Column]
    private ?string $password = null;

    #[Assert\NotBlank(groups: ['user_write'])]
    #[Groups(['user_write', 'user:update'])]
    private ?string $plainPassword = null;

    #[Groups(['user:active', 'user:update-password'])]
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

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Pastrie::class)]
    private Collection $pastries;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: MasterClass::class)]
    private Collection $masterClasses;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Ordered::class)]
    private Collection $ordereds;

    #[ORM\OneToMany(mappedBy: 'userId', targetEntity: Reservation::class)]
    private Collection $reservations;

    public function __construct()
    {
        $this->pastries = new ArrayCollection();
        $this->masterClasses = new ArrayCollection();
        $this->ordereds = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Pastrie>
     */
    public function getPastries(): Collection
    {
        return $this->pastries;
    }

    public function addPastry(Pastrie $pastry): self
    {
        if (!$this->pastries->contains($pastry)) {
            $this->pastries->add($pastry);
            $pastry->setOwner($this);
        }
        return $this;
    }

    public function removePastry(Pastrie $pastry): self
    {
        if ($this->pastries->removeElement($pastry)) {
            // set the owning side to null (unless already changed)
            if ($pastry->getOwner() === $this) {
                $pastry->setOwner(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, MasterClass>
     */
    public function getMasterClasses(): Collection
    {
        return $this->masterClasses;
    }

    public function addMasterClass(MasterClass $masterClass): self
    {
        if (!$this->masterClasses->contains($masterClass)) {
            $this->masterClasses->add($masterClass);
            $masterClass->setOwner($this);
        }
        return $this;
    }


    public function removeMasterClass(MasterClass $masterClass): self
    {
        if ($this->masterClasses->removeElement($masterClass)) {
            // set the owning side to null (unless already changed)
            if ($masterClass->getOwner() === $this) {
                $masterClass->setOwner(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Ordered>
     */
    public function getOrdereds(): Collection
    {
        return $this->ordereds;
    }

    public function addOrdered(Ordered $ordered): self
    {
        if (!$this->ordereds->contains($ordered)) {
            $this->ordereds->add($ordered);
            $ordered->setOwner($this);
        }
        return $this;
    }

    public function removeOrdered(Ordered $ordered): self
    {
        if ($this->ordereds->removeElement($ordered)) {
            // set the owning side to null (unless already changed)
            if ($ordered->getOwner() === $this) {
                $ordered->setOwner(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setUserId($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getUserId() === $this) {
                $reservation->setUserId(null);
            }
        }

        return $this;
    }
}
