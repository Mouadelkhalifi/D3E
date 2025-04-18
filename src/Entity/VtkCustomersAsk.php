<?php

namespace App\Entity;

use App\Repository\VtkCustomersAskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VtkCustomersAskRepository::class)]
class VtkCustomersAsk
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'vtkCustomersAsks')]
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
