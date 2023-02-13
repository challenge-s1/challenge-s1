<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Pastrie;
use App\Entity\MasterClass;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CartRepository;
use ApiPlatform\Metadata\ApiFilter;
use App\Controller\StripeController;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\Cart\GetCartItems;
use App\Entity\Traits\TimestampTrait;
use ApiPlatform\Metadata\GetCollection;
use Gedmo\Mapping\Annotation\Blameable;
use App\Controller\AddPastrieToCartController;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\AddMasterClassToCartController;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CartRepository::class)]
#[ApiResource(
    uriTemplate: '/users/{id}/carts',
    uriVariables: [
        'id' => new Link(
            fromClass: User::class,
            toProperty: 'client',
        ),
    ],
    security: 'is_granted("ROLE_ADMIN") or user.getId() == id',
    operations: [
        new GetCollection(
        ),
        new Post(
            name: 'checkout_cart',
            uriTemplate: '/users/{id}/carts/checkout',
            controller: StripeController::class,
            normalizationContext: ['groups' => ['none']],
            denormalizationContext: ['groups' => ['none']],
            read: false,
        )],
        
    
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

    #[ApiResource(
        security: 'is_granted("ROLE_USER")',
        operations: [
            new Post( 
                name: 'add_masterclass_cart',
                uriTemplate: '/carts/masterClass/{mId}',
                controller: AddMasterClassToCartController::class,
                normalizationContext: ['groups' => ['none']],
                denormalizationContext: ['groups' => ['none']],
                
                uriVariables: [
        
                    'mId' => new Link(
                        fromClass: MasterClass::class,
                        toProperty: 'masterClass',
                    )
                ],
                read: false,
            ),
            new Post(
                name: 'add_pastrie_cart',
                uriTemplate: '/carts/pastrie/{pId}',
                controller: AddPastrieToCartController::class,
                normalizationContext: ['groups' => ['none']],
                denormalizationContext: ['groups' => ['none']],
                
                uriVariables: [
                    'pId' => new Link(
                        fromClass: Pastrie::class,
                        toProperty: 'cake',
                    )
                ],
                read: false,
            ),
            
        ],
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
    #[Groups(['pastrie_read', 'pastrie_write'])]
    // #[Groups(['pastrie_read'])]
    private ?Pastrie $cake = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
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
