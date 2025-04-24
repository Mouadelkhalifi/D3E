<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VtkMaterialsLotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VtkMaterialsLotRepository::class)]
#[ApiResource]
class VtkMaterialsLot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $weightKg = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $collectedDate = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $processingStatus = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'lots')]
    private ?VtkCustomerAsk $ask = null;

    #[ORM\ManyToOne(inversedBy: 'lots')]
    private ?VtkMaterialsType $type = null;

    /**
     * @var Collection<int, VtkDocument>
     */
    #[ORM\OneToMany(targetEntity: VtkDocument::class, mappedBy: 'lot')]
    private Collection $documents;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeightKg(): ?string
    {
        return $this->weightKg;
    }

    public function setWeightKg(?string $weightKg): static
    {
        $this->weightKg = $weightKg;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCollectedDate(): ?\DateTimeInterface
    {
        return $this->collectedDate;
    }

    public function setCollectedDate(?\DateTimeInterface $collectedDate): static
    {
        $this->collectedDate = $collectedDate;

        return $this;
    }

    public function getProcessingStatus(): ?string
    {
        return $this->processingStatus;
    }

    public function setProcessingStatus(?string $processingStatus): static
    {
        $this->processingStatus = $processingStatus;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

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

    public function getAsk(): ?VtkCustomerAsk
    {
        return $this->ask;
    }

    public function setAsk(?VtkCustomerAsk $ask): static
    {
        $this->ask = $ask;

        return $this;
    }

    public function getType(): ?VtkMaterialsType
    {
        return $this->type;
    }

    public function setType(?VtkMaterialsType $type): static
    {
        $this->type = $type;

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
            $document->setLot($this);
        }

        return $this;
    }

    public function removeDocument(VtkDocument $document): static
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getLot() === $this) {
                $document->setLot(null);
            }
        }

        return $this;
    }
}
