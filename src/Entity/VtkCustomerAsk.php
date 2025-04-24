<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VtkCustomerAskRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: VtkCustomerAskRepository::class)]
#[ApiResource]
class VtkCustomerAsk
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $requestDate = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $pickupAddress = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $pickupDate = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'vtkCustomerAsks')]
    private ?VtkCustomer $customer = null;

    /**
     * @var Collection<int, VtkMaterialsLot>
     */
    #[ORM\OneToMany(targetEntity: VtkMaterialsLot::class, mappedBy: 'ask')]
    private Collection $lots;

    /**
     * @var Collection<int, VtkDocument>
     */
    #[ORM\OneToMany(targetEntity: VtkDocument::class, mappedBy: 'ask')]
    private Collection $documents;

    public function __construct()
    {
        $this->lots = new ArrayCollection();
        $this->documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequestDate(): ?\DateTimeInterface
    {
        return $this->requestDate;
    }

    public function setRequestDate(\DateTimeInterface $requestDate): static
    {
        $this->requestDate = $requestDate;

        return $this;
    }

    public function getPickupAddress(): ?string
    {
        return $this->pickupAddress;
    }

    public function setPickupAddress(?string $pickupAddress): static
    {
        $this->pickupAddress = $pickupAddress;

        return $this;
    }

    public function getPickupDate(): ?\DateTimeInterface
    {
        return $this->pickupDate;
    }

    public function setPickupDate(?\DateTimeInterface $pickupDate): static
    {
        $this->pickupDate = $pickupDate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

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
    public function getCustomer(): ?VtkCustomer
    {
        return $this->customer;
    }

    public function setCustomer(?VtkCustomer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection<int, VtkMaterialsLot>
     */
    public function getLots(): Collection
    {
        return $this->lots;
    }

    public function addLot(VtkMaterialsLot $lot): static
    {
        if (!$this->lots->contains($lot)) {
            $this->lots->add($lot);
            $lot->setAsk($this);
        }

        return $this;
    }

    public function removeLot(VtkMaterialsLot $lot): static
    {
        if ($this->lots->removeElement($lot)) {
            // set the owning side to null (unless already changed)
            if ($lot->getAsk() === $this) {
                $lot->setAsk(null);
            }
        }

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
            $document->setAsk($this);
        }

        return $this;
    }

    public function removeDocument(VtkDocument $document): static
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getAsk() === $this) {
                $document->setAsk(null);
            }
        }

        return $this;
    }
}
