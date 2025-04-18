<?php

namespace App\Entity;

use App\Repository\VtkUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VtkUserRepository::class)]
class VtkUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(length: 150)]
    private ?string $email = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, VtkDocument>
     */
    #[ORM\OneToMany(targetEntity: VtkDocument::class, mappedBy: 'uploadedBy')]
    private Collection $documents;

    /**
     * @var Collection<int, VtkAuditLog>
     */
    #[ORM\OneToMany(targetEntity: VtkAuditLog::class, mappedBy: 'relatedUser')]
    private Collection $auditLogs;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->auditLogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, VtkDocument>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(VtkDocument $document): static
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setUploadedBy($this);
        }

        return $this;
    }

    public function removeDocument(VtkDocument $document): static
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getUploadedBy() === $this) {
                $document->setUploadedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VtkAuditLog>
     */
    public function getAuditLogs(): Collection
    {
        return $this->auditLogs;
    }

    public function addAuditLog(VtkAuditLog $auditLog): static
    {
        if (!$this->auditLogs->contains($auditLog)) {
            $this->auditLogs->add($auditLog);
            $auditLog->setRelatedUser($this);
        }

        return $this;
    }

    public function removeAuditLog(VtkAuditLog $auditLog): static
    {
        if ($this->auditLogs->removeElement($auditLog)) {
            // set the owning side to null (unless already changed)
            if ($auditLog->getRelatedUser() === $this) {
                $auditLog->setRelatedUser(null);
            }
        }

        return $this;
    }
}
