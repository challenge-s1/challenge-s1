<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\OrderedRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\TimestampTrait;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrderedRepository::class)]
#[ApiResource(
    order: ['created_at' => 'DESC'],
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['order_read', 'pastrie_read', 'category_read']]
        ),


        new Get(
            normalizationContext: ['groups' => ['order_read', 'pastrie_read', 'category_read']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['order_write']],
            security: 'is_granted("ROLE_PATISSIER") ',
        ),
    ],
    normalizationContext: ['groups' => ['order_read', 'timestampable']],
    denormalizationContext: ['groups' => ['order_write', 'timestampable']],
)]
class Ordered
{
    use TimestampTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['order_read'])]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['order_read'])]
    private ?Pastrie $pastrie = null;

    #[ORM\Column]
    #[Groups(['order_read'])]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'ordereds')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['order_read'])]
    private ?User $owner = null;

    #[ORM\Column(options: ['default' => false])]
    #[Groups(['order_read', 'order_write'])]
    private ?bool $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPastrie(): ?Pastrie
    {
        return $this->pastrie;
    }

    public function setPastrie(?Pastrie $pastrie): self
    {
        $this->pastrie = $pastrie;

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

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
