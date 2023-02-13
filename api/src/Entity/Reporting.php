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
use App\Controller\ReportingController;
use App\Repository\ReportingRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\TimestampTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation\Blameable;

#[ORM\Entity(repositoryClass: ReportingRepository::class)]
#[ApiResource(

    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['reporting_read']]
        ),
        new Post(
            uriTemplate: '/reportings',
            controller: ReportingController::class,
            denormalizationContext: ['groups' => ['reporting_write']],
        ),
        new Get(
            normalizationContext: ['groups' => ['reporting_read']]
        ),
        // new Put(
        //     denormalizationContext: ['groups' => ['reason_write']],
        //     security: 'is_granted("ROLE_ADMIN")'
        // ),
        new Delete(
            security: 'is_granted("ROLE_ADMIN")'
        ),
    ],
    normalizationContext: ['groups' => ['reporting_read', 'timestampable']],
    denormalizationContext: ['groups' => ['reporting_write', 'timestampable']],
)]
class Reporting
{
    use TimestampTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['reporting_read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reportings')]
    #[Groups(['reporting_read', 'reporting_write'])]
    private ?Comment $commentid = null;

    #[ORM\ManyToOne(inversedBy: 'reportings')]
    #[Groups(['reporting_read', 'comment_read'])]
    #[Blameable(on: 'create')]
    private ?User $userid = null;

    #[ORM\ManyToOne(inversedBy: 'reportings')]
    #[Groups(['reporting_read', 'reporting_write'])]
    private ?ReasonReporting $reason = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentid(): ?Comment
    {
        return $this->commentid;
    }

    public function setCommentid(?Comment $commentid): self
    {
        $this->commentid = $commentid;

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

    public function getReason(): ?ReasonReporting
    {
        return $this->reason;
    }

    public function setReason(?ReasonReporting $reason): self
    {
        $this->reason = $reason;

        return $this;
    }
}
