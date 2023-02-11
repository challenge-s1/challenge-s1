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
use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\TimestampTrait;
use Gedmo\Mapping\Annotation\Blameable;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
#[ApiResource(

    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['comment_read', 'masterClass:read']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['comment_write']],
        ),
        new Get(
            normalizationContext: ['groups' => ['comment_read', 'masterClass:read']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['comment_write']],
            security: 'object.getUserid() == user',
        ),
        new Delete(
            security: 'is_granted("ROLE_ADMIN") or object.getUserid() == user',
        ),
    ],
    normalizationContext: ['groups' => ['comment_read', 'timestampable']],
    denormalizationContext: ['groups' => ['comment_write', 'timestampable']],
)]
class Comment
{
    use TimestampTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['comment_read', 'masterClass:read', 'reporting_read'])]
    private ?int $id = null;

    #[Groups(['comment_write', 'comment_read', 'masterClass:read', 'reporting_read'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;


    #[ORM\ManyToOne(inversedBy: 'comments', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Blameable(on: 'create')]
    #[Groups(['comment_read', 'masterClass:read', 'reporting_read'])]
    private ?User $userid = null;


    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[Groups(['comment_write', 'comment_read', 'reporting_read'])]
    private ?MasterClass $masterid = null;

    #[ORM\OneToMany(mappedBy: 'commentid', targetEntity: Reporting::class)]
    private Collection $reportings;

    public function __construct()
    {
        $this->reportings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getUserid(): ?User
    {
        return $this->userid;
    }

    public function setUserid(?User $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getMasterid(): ?MasterClass
    {
        return $this->masterid;
    }

    public function setMasterid(?MasterClass $masterid): self
    {
        $this->masterid = $masterid;

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
            $reporting->setCommentid($this);
        }

        return $this;
    }

    public function removeReporting(Reporting $reporting): self
    {
        if ($this->reportings->removeElement($reporting)) {
            // set the owning side to null (unless already changed)
            if ($reporting->getCommentid() === $this) {
                $reporting->setCommentid(null);
            }
        }

        return $this;
    }
}
