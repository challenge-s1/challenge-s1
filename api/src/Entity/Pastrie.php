<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;

use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\PastrieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation\Blameable;

#[ORM\Entity(repositoryClass: PastrieRepository::class)]

#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['pastrie_read', 'category_read']]
        ),

        new Post(
            denormalizationContext: ['groups' => ['pastrie_write']],
            security: 'is_granted("ROLE_PATISSIER")',
            // denormalizationContext: ['groups' => ['pastrie_write']],
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
    // normalizationContext: ['groups' => ['pastrie_read']],
    // denormalizationContext: ['groups' => ['pastrie_write']],
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
        new GetCollection()
    ],

)]
class Pastrie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    // #[ApiProperty(identifier: true)]
    // #[Groups('pastrie_read', 'category_read')]
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


    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['pastrie_read', 'pastrie_write', 'category_read'])]
    // #[Groups(['pastrie_read', 'pastrie_write', 'category_read'])]
    private ?string $picture = null;


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
}
