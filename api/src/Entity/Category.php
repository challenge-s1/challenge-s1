<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[
    ApiResource(
        operations: [
            new GetCollection(
                normalizationContext: ['groups' => ['category_read', 'pastrie_read']],
            ),
            new Get(
                normalizationContext: ['groups' => ['category_read']],
            ),
            new Post(
                denormalizationContext: ['groups' => ['category_write']],
                security: 'is_granted("ROLE_ADMIN")',
            ),
            new Put(
                denormalizationContext: ['groups' => ['category_write']],
                security: 'is_granted("ROLE_ADMIN")',

            ),
            new Delete(
                security: 'is_granted("ROLE_ADMIN")',
            ),
        ],
        normalizationContext: ['groups' => ['category_read']],
        denormalizationContext: ['groups' => ['category_write']],
    )
]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['category_read', 'pastrie_read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['category_read', 'category_write', 'pastrie_read'])]
    // #[Groups('category_read', 'category_write')]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Pastrie::class, cascade: ['persist', 'remove'])]
    #[Groups(['category_read'])]
    // #[Groups('category_read', 'category_write')]
    private Collection $pastries;

    public function __construct()
    {
        $this->pastries = new ArrayCollection();
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
            $pastry->setCategory($this);
        }

        return $this;
    }

    public function removePastry(Pastrie $pastry): self
    {
        if ($this->pastries->removeElement($pastry)) {
            // set the owning side to null (unless already changed)
            if ($pastry->getCategory() === $this) {
                $pastry->setCategory(null);
            }
        }

        return $this;
    }
}
