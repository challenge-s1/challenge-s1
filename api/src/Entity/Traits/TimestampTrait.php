<?php
namespace App\Entity\Traits;

use DateTimeImmutable;

trait TimestampTrait
{
    /**
     * @var \DateTime
     */
    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(name: 'created_at', type: Types::DATE_MUTABLE)]
    #[Groups(['timestampable'])]
    private $created_at;

    /**
     * @var \DateTime
     */
    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(name: 'updated_at', type: Types::DATE_MUTABLE)]
    #[Groups(['timestampable'])]
    private $updated_at;

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
    /** @phpstan-ignore-next-line */
    public function getUpdatedAt(): ?\DateTimeImmutable  /** @phpstan-ignore-line */
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
