<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;

use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\CreateMediaObjectAction;
use App\Entity\Traits\TimestampTrait;
use App\Repository\PastrieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation\Blameable;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: PastrieRepository::class)]

#[ApiResource(
    order: ['created_at' => 'ASC'],
    types: ['https://schema.org/Pastrie'],
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['pastrie_read', 'category_read']]
        ),

        new Post(

            denormalizationContext: ['groups' => ['pastrie_write']],
            security: 'is_granted("ROLE_PATISSIER")',
            // denormalizationContext: ['groups' => ['pastrie_write']],
        ),
        new Post(
            uriTemplate: '/users/images/{id}/passtries',
            controller: CreateMediaObjectAction::class,
            deserialize: false,
            openapiContext: [
                'requestBody' => [
                    'content' => [
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'imageFile' => [
                                        'type' => 'string',
                                        'format' => 'binary',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            // uriVariables: [
            //     'id' => new Link(
            //         fromClass: User::class,
            //         toProperty: 'owner',
            //     )
            // ],
            // denormalizationContext: ['groups' => ['pastrie_write']],
            //security: 'is_granted("ROLE_PATISSIER")',
        ),
        new Get(
            normalizationContext: ['groups' => ['pastrie_read', 'category_read']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['pastrie_write']],
            security: 'is_granted("ROLE_ADMIN") or object.getOwner() == user',
        ),
        new Delete(
            security: 'is_granted("ROLE_ADMIN") or object.getOwner() == user',
        ),
    ],
    normalizationContext: ['groups' => ['pastrie_read', 'timestampable']],
    denormalizationContext: ['groups' => ['pastrie_write', 'timestampable']],
)]
#[ApiResource(
    uriTemplate: '/users/{id}/passtries',
    uriVariables: [
        'id' => new Link(
            fromClass: User::class,
            toProperty: 'owner',
        )
    ],
    security: ' user.getId() == id',
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['pastrie_read', 'category_read']]
        )
    ],
)]
#[ApiFilter(DateFilter::class, properties: ['createdAt'])]
class Pastrie
{
    use TimestampTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['pastrie_read', 'category_read'])]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    // #[Groups(['pastrie_read', 'pastrie_write', 'category_read'])]
    #[Groups(['pastrie_read', 'pastrie_write', 'category_read'])]
    private ?string $name = null;


    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['pastrie_read', 'pastrie_write', 'category_read'])]
    // #[Groups(['pastrie_read', 'pastrie_write', 'category_read'])]
    private ?string $description = null;


    #[ORM\Column]
    #[Groups(['pastrie_read', 'pastrie_write', 'category_read'])]
    // #[Groups(['pastrie_read', 'pastrie_write', 'category_read'])]
    private ?float $price = null;

    #[ApiProperty(types: ['https://schema.org/contentUrl'])]
    #[Groups(['pastrie_read'])]
    public  ?string $contentUrl = null;


    //#[Groups(['pastrie_read', 'pastrie_write', 'category_read'])]
    #[Vich\UploadableField(mapping: 'product_image', fileNameProperty: 'picture')]
    public  ?File $imageFile = null;


    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['pastrie_read', 'pastrie_write', 'category_read'])]
    // #[Groups(['pastrie_read', 'pastrie_write', 'category_read'])]
    public  ?string $picture = null;



    #[ORM\ManyToOne(inversedBy: 'pastries')]
    // #[Groups('pastrie_read', 'user_read')]
    #[ORM\JoinColumn(nullable: false)]
    #[Blameable(on: 'create')]
    #[Groups(['pastrie_read', 'category_read'])]
    private ?User $owner = null;


    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'pastries')]
    #[ORM\JoinColumn(nullable: false)]
    // #[Groups('pastrie_write', 'pastrie_read', 'category_read')]
    #[ApiProperty(writableLink: true)]
    // #[ApiProperty(identifier: true)]
    #[Groups(['pastrie_read', 'pastrie_write'])]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'cake', targetEntity: Cart::class)]
    private Collection $cartItems;

    #[Groups(['pastrie_read', 'pastrie_write'])]
    #[ORM\Column(type: 'boolean', nullable: true, options: ['default' => false])]
    private ?bool $Status = false;


    // #[ORM\Column(nullable: true)]
    // #[Groups(['pastrie_read', 'pastrie_write'])]
    // private ?\DateTimeImmutable $updatedAt = null;



    public function __construct()
    {
        $this->cartItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
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
    public function getContentUrl(): ?string
    {
        return $this->contentUrl;
    }

    public function setContentUrl(string $contentUrl): self
    {
        $this->contentUrl = $contentUrl;

        return $this;
    }
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updated_at = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

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
            $cartItem->setCake($this);
        }

        return $this;
    }

    public function removeCartItem(Cart $cartItem): self
    {
        if ($this->cartItems->removeElement($cartItem)) {
            // set the owning side to null (unless already changed)
            if ($cartItem->getCake() === $this) {
                $cartItem->setCake(null);
            }
        }

        return $this;
    }

    // public function getUpdatedAt(): ?\DateTimeImmutable
    // {
    //     return $this->updatedAt;
    // }

    // public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    // {
    //     $this->updatedAt = $updatedAt;

    //     return $this;
    // }

    public function isStatus(): ?bool
    {
        return $this->Status;
    }

    public function setStatus(bool $Status): self
    {
        $this->Status = $Status;

        return $this;
    }
}
