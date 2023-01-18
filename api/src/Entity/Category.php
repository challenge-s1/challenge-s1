<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Pastrie::class)]
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
