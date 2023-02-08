<?php

namespace App\Entity;

use App\Controller\GetUser;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Post;
use App\Controller\UpdateUser;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\Activatecount;
// use App\State\UserPasswordHasher;
use App\Repository\UserRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\ResetPasswordController;
use Doctrine\Common\Collections\Collection;
use App\Controller\UpdatePasswordController;
use App\Entity\Traits\TimestampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    security: "is_granted('ROLE_ADMIN') or object == user",
)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(),
        new Put(),
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
        new Patch(
            security: "is_granted('ROLE_ADMIN') or object.getOwner() == user",
            denormalizationContext: ['groups' => ['user_update']]
        ),
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
    normalizationContext: ['groups' => ['user_read', 'timestampable']],
    denormalizationContext: ['groups' => ['user_write', 'timestampable']],
)]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TimestampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    #[Groups(['masterClass:details', 'pastrie_read', 'user_read'])]
    private ?int $id = null;

    #[Groups(['user_write', 'user:update', 'user:reset-password', 'masterClass:read', 'masterClass:details', 'user_cart'])]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[Groups(['user_read', 'pastrie_read'])]
    #[ORM\Column(type: 'json')]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[Groups(['user_write', 'user:update', 'user:update-password',])]
    #[ORM\Column]
    private ?string $password = null;

    #[Assert\NotBlank(groups: ['user_write'])]
    #[Groups(['user_write'])]
    private ?string $plainPassword = null;

    #[Groups(['user:active', 'user:update-password'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    #[Groups(['user_write', 'user_read', 'masterClass:read', 'pastrie_read', 'user_update'])]
    #[ORM\Column(length: 255)]
    private ?string $firstName = null;


    #[Groups(['user_write', 'user_read', 'user_update', 'masterClass:read', 'pastrie_read'])]
    #[ORM\Column(length: 255)]
    private ?string $lastName = null;


    #[Groups(['user_write', 'user_read', 'user_update', 'pastrie_read'])]
    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[Groups(['user_write', 'user_read', 'pastrie_read', 'user_update'])]
    #[ORM\Column]
    private ?int $postalcode = null;

    #[Groups(['user_write', 'user_read', 'user_update', 'pastrie_read'])]
    #[ORM\Column(length: 255)]
    private ?string $address = null;


    #[Groups(['user_write', 'user_read', 'pastrie_read', 'user_update'])]
    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[Groups(['user_write'])]
    #[ORM\Column(type: 'boolean', nullable: true, options: ['default' => false])]
    private ?bool $is_Active = false;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Pastrie::class)]
    private Collection $pastries;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: MasterClass::class)]
    private Collection $masterClasses;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Ordered::class)]
    private Collection $ordereds;

    #[ORM\OneToMany(mappedBy: 'userId', targetEntity: Reservation::class)]
    private Collection $reservations;


    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: VoucherDiscount::class)]
    private Collection $voucherDiscounts;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Cart::class, orphanRemoval: true)]
    #[Groups(['user_cart'])]
    private Collection $cartItems;


    public function __construct()
    {
        $this->pastries = new ArrayCollection();
        $this->masterClasses = new ArrayCollection();
        $this->ordereds = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->voucherDiscounts = new ArrayCollection();
        $this->cartItems = new ArrayCollection();
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

    /**
     * @return Collection<int, VoucherDiscount>
     */
    public function getVoucherDiscounts(): Collection
    {
        return $this->voucherDiscounts;
    }

    public function addVoucherDiscount(VoucherDiscount $voucherDiscount): self
    {
        if (!$this->voucherDiscounts->contains($voucherDiscount)) {
            $this->voucherDiscounts->add($voucherDiscount);
            $voucherDiscount->setOwner($this);
        }
        return $this;
    }

    /**
     * @return Collection<int, Cart>
     */
    public function getCartItems(): Collection
    {
        return $this->cartItems;
    }

    public function addCartItem(Cart $cartItem): self
    {
        if (!$this->cartItems->contains($cartItem)) {
            $this->cartItems->add($cartItem);
            $cartItem->setClient($this);
        }

        return $this;
    }

    public function removeVoucherDiscount(VoucherDiscount $voucherDiscount): self
    {
        if ($this->voucherDiscounts->removeElement($voucherDiscount)) {
            // set the owning side to null (unless already changed)
            if ($voucherDiscount->getOwner() === $this) {
                $voucherDiscount->setOwner(null);
            }
        }
        return $this;
    }

    public function removeCartItem(Cart $cartItem): self
    {
        if ($this->cartItems->removeElement($cartItem)) {
            // set the owning side to null (unless already changed)
            if ($cartItem->getClient() === $this) {
                $cartItem->setClient(null);
            }
        }

        return $this;
    }
}
