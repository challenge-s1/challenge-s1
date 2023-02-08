<?php

namespace App\Entity;

use App\Entity\User;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CartRepository;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\Cart\GetCartItems;
use App\Entity\Traits\TimestampTrait;
use ApiPlatform\Metadata\GetCollection;
use Gedmo\Mapping\Annotation\Blameable;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CartRepository::class)]
#[ApiResource()]
#[ApiResource(
    uriTemplate: '/users/{id}/carts',
    uriVariables: [
        'id' => new Link(
            fromClass: User::class,
            toProperty: 'client',
        )],
    security: 'is_granted("ROLE_ADMIN") or user.getId() == id',
    operations: [
    new GetCollection(),
    new Post()
    ],
    normalizationContext: ['groups' => ['cart_read', 'user_read', 'pastrie_read', 'masterClass:read', 'timestampable']],
    denormalizationContext: ['groups' => ['cart_write', 'user_write', 'pastrie_write', 'masterClass:write', 'timestampable']],
    )]
    #[ApiResource(
        uriTemplate: '/users/{userId}/carts/{id}',
        uriVariables: [
            'userId' => new Link(
                fromClass: User::class,
                toProperty: 'client',
            ),
            'id' => new Link(fromClass: Cart::class)
        ],
        security: 'is_granted("ROLE_ADMIN") or user.getId() == userId',
        operations: [
            new Delete(),
            new Patch(),
        ]
    )]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['cart_read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cartItems')]
    #[ORM\JoinColumn(nullable: false)]
    #[Blameable(on: 'create')]
    #[Groups(['user_read'])]
    private ?User $client = null;

    #[ORM\Column]
    #[Groups(['cart_read'])]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'cartItems')]
    #[Blameable(on: 'create')]
    #[Groups(['pastrie_read', 'pastrie_write'])]
    private ?Pastrie $cake = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    #[Blameable(on: 'create')]
    #[Groups(['masterClass:read'])]
    private ?MasterClass $masterClass = null;

    use TimestampTrait;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCake(): ?Pastrie
    {
        return $this->cake;
    }

    public function setCake(?Pastrie $cake): self
    {
        $this->cake = $cake;

        return $this;
    }

    public function getMasterClass(): ?MasterClass
    {
        return $this->masterClass;
    }

    public function setMasterClass(?MasterClass $masterClass): self
    {
        $this->masterClass = $masterClass;

        return $this;
    }
}
