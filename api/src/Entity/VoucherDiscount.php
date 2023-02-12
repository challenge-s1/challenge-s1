<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\VoucherDiscountRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Link;

#[ORM\Entity(repositoryClass: VoucherDiscountRepository::class)]
#[ApiResource]

#[ApiResource(
    uriTemplate: '/users/{id}/vouchers',
    uriVariables: [
        'id' => new Link(
            fromClass: User::class,
            toProperty: 'owner',
        )],
    security: 'is_granted("ROLE_ADMIN") or user.getId() == id',
    operations: [
    new GetCollection()
    ],
    normalizationContext: ['groups' => ['voucher_read']],
    denormalizationContext: ['groups' => ['voucher_write']]
    )]
class VoucherDiscount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['voucher_read'])]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'voucherDiscounts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
