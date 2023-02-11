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
use App\Repository\ReasonReportingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\TimestampTrait;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReasonReportingRepository::class)]
#[ApiResource(

    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['reason_read']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['reason_write']],
            security: 'is_granted("ROLE_ADMIN")',
        ),
        new Get(
            normalizationContext: ['groups' => ['reason_read']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['reason_write']],
            security: 'is_granted("ROLE_ADMIN")'
        ),
        new Delete(
            security: 'is_granted("ROLE_ADMIN")'
        ),
    ],
    normalizationContext: ['groups' => ['reason_read', 'timestampable']],
    denormalizationContext: ['groups' => ['reason_write', 'timestampable']],
)]
class ReasonReporting
{
    use TimestampTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['reason_read', 'reporting_read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['reason_read', 'reason_write', 'reporting_read'])]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'reason', targetEntity: Reporting::class)]
    private Collection $reportings;

    public function __construct()
    {
        $this->reportings = new ArrayCollection();
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

    /**
     * @return Collection<int, Reporting>
     */
    public function getReportings(): Collection
    {
        return $this->reportings;
    }

    public function addReporting(Reporting $reporting): self
    {
        if (!$this->reportings->contains($reporting)) {
            $this->reportings->add($reporting);
            $reporting->setReason($this);
        }

        return $this;
    }

    public function removeReporting(Reporting $reporting): self
    {
        if ($this->reportings->removeElement($reporting)) {
            // set the owning side to null (unless already changed)
            if ($reporting->getReason() === $this) {
                $reporting->setReason(null);
            }
        }

        return $this;
    }
}
