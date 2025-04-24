<?php

namespace App\Entity;

use App\Repository\VtkAuditLogRepository;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VtkAuditLogRepository::class)]
#[ApiResource]
class VtkAuditLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $actionType = null;

    #[ORM\Column(length: 100)]
    private ?string $entity = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $actionDetails = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $timestamp = null;

    #[ORM\ManyToOne(inversedBy: 'auditLogs')]
    private ?VtkUser $relatedUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActionType(): ?string
    {
        return $this->actionType;
    }

    public function setActionType(string $actionType): static
    {
        $this->actionType = $actionType;

        return $this;
    }

    public function getEntity(): ?string
    {
        return $this->entity;
    }

    public function setEntity(string $entity): static
    {
        $this->entity = $entity;

        return $this;
    }

    public function getActionDetails(): ?string
    {
        return $this->actionDetails;
    }

    public function setActionDetails(string $actionDetails): static
    {
        $this->actionDetails = $actionDetails;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeImmutable
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeImmutable $timestamp): static
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getRelatedUser(): ?VtkUser
    {
        return $this->relatedUser;
    }

    public function setRelatedUser(?VtkUser $relatedUser): static
    {
        $this->relatedUser = $relatedUser;

        return $this;
    }
}
