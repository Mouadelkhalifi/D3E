<?php

namespace App\Entity;

use App\Repository\VtkMaterialsTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VtkMaterialsTypeRepository::class)]
class VtkMaterialsType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $typeName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'types')]
    private ?VtkMaterialsCategory $category = null;

    /**
     * @var Collection<int, VtkMaterialsLot>
     */
    #[ORM\OneToMany(targetEntity: VtkMaterialsLot::class, mappedBy: 'type')]
    private Collection $lots;

    public function __construct()
    {
        $this->lots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeName(): ?string
    {
        return $this->typeName;
    }

    public function setTypeName(string $typeName): static
    {
        $this->typeName = $typeName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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

    public function getCategory(): ?VtkMaterialsCategory
    {
        return $this->category;
    }

    public function setCategory(?VtkMaterialsCategory $category): static
    {
        $this->category = $category;

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
            $lot->setType($this);
        }

        return $this;
    }

    public function removeLot(VtkMaterialsLot $lot): static
    {
        if ($this->lots->removeElement($lot)) {
            // set the owning side to null (unless already changed)
            if ($lot->getType() === $this) {
                $lot->setType(null);
            }
        }

        return $this;
    }
}
