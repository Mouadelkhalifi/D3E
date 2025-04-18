<?php

namespace App\Entity;

use App\Repository\VtkMaterialsCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VtkMaterialsCategoryRepository::class)]
class VtkMaterialsCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $categoryName = null;

    /**
     * @var Collection<int, VtkMaterialsType>
     */
    #[ORM\OneToMany(targetEntity: VtkMaterialsType::class, mappedBy: 'category')]
    private Collection $types;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(?string $categoryName): static
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * @return Collection<int, VtkMaterialsType>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(VtkMaterialsType $type): static
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            $type->setCategory($this);
        }

        return $this;
    }

    public function removeType(VtkMaterialsType $type): static
    {
        if ($this->types->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getCategory() === $this) {
                $type->setCategory(null);
            }
        }

        return $this;
    }
}
