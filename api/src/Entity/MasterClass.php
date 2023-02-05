<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\CancelMasterClassController;
use App\Repository\MasterClassRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Blameable;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MasterClassRepository::class)]
#[ApiResource(
    operations: [

        new GetCollection(
            normalizationContext: [
                'groups' => ['masterClass:read'],
            ],
        ),

        new Get(
            normalizationContext: [
                'groups' => ['masterClass:details', 'masterClass:read'],
            ]
        ),

        new Post(
            security: 'is_granted("ROLE_PATISSIER")',
            securityMessage: 'Only authenticated users can create master classes.',
            denormalizationContext: [
                'groups' => ['masterClass:write'],
            ],
        ),

        new Put(
            security: 'is_granted("ROLE_PATISSIER") and object.getOwner() == user',
            securityMessage: 'Only the owner of the master class can edit it.',
            denormalizationContext: [
                'groups' => ['masterClass:update'],
            ],
        ),
        new Delete(
            security: 'is_granted("ROLE_PATISSIER") and object.getOwner() == user',
            securityMessage: 'Only the owner of the master class can cancel it.',
            uriTemplate: '/master-classes/{id}/cancel',
            controller: CancelMasterClassController::class,
        )
    ],
    normalizationContext: ['groups' => ['masterclass_read']]
)]
#[ApiResource(
    uriTemplate: '/users/{id}/master_classes',
    uriVariables: [
        'id' => new Link(fromClass: User::class, toProperty: 'owner'),
    ],
    security: 'is_granted("ROLE_PATISSIER") and user.getId() == id',
    operations: [new GetCollection(
        normalizationContext: [
            'groups' => ['masterClass:details', 'masterClass:read'],
        ],
    )],

)]
class MasterClass
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['masterClass:write', 'masterClass:update', 'masterClass:read'])]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Groups(['masterClass:write', 'masterClass:update', 'masterClass:read'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[Groups(['masterClass:write', 'masterClass:read'])]
    #[ORM\Column]
    private ?float $price = null;

    #[Groups(['masterClass:write', 'masterClass:update', 'masterClass:read'])]
    #[ORM\Column]
    private ?int $maxNumber = null;

    #[Blameable(on: 'create')]
    #[Groups(['masterClass:read'])]
    #[ORM\ManyToOne(inversedBy: 'masterClasses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\OneToMany(mappedBy: 'masterClass', targetEntity: Reservation::class)]
    #[Groups(['masterClass:details'])]
    private Collection $reservations;

    #[ORM\Column(nullable: true)]
    #[Groups(['masterClass:read'])]
    private ?bool $isCanceled = null;

    #[ORM\OneToMany(mappedBy: 'masterClass', targetEntity: Cart::class)]
    private Collection $carts;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->carts = new ArrayCollection();
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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getMaxNumber(): ?int
    {
        return $this->maxNumber;
    }

    public function setMaxNumber(int $maxNumber): self
    {
        $this->maxNumber = $maxNumber;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

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
            $reservation->setMasterClass($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getMasterClass() === $this) {
                $reservation->setMasterClass(null);
            }
        }

        return $this;
    }

    public function isIsCanceled(): ?bool
    {
        return $this->isCanceled;
    }

    public function setIsCanceled(?bool $isCanceled): self
    {
        $this->isCanceled = $isCanceled;
        return $this;
    }
    /**
     * @return Collection<int, Cart>
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->carts->contains($cart)) {
            $this->carts->add($cart);
            $cart->setMasterClass($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getMasterClass() === $this) {
                $cart->setMasterClass(null);
            }
        }
        return $this;
    }
}
