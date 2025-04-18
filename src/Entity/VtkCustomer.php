<?php

namespace App\Entity;

use App\Repository\VtkCustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VtkCustomerRepository::class)]
class VtkCustomer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $companyName = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $siret = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 20)]
    private ?string $postalCode = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $country = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, VtkContact>
     */
    #[ORM\OneToMany(targetEntity: VtkContact::class, mappedBy: 'customer')]
    private Collection $vtkContacts;

    #[ORM\OneToOne(inversedBy: 'vtkCustomer', cascade: ['persist', 'remove'])]
    private ?VtkContact $primaryContact = null;

    /**
     * @var Collection<int, VtkCustomersAsk>
     */
    #[ORM\OneToMany(targetEntity: VtkCustomersAsk::class, mappedBy: 'customer')]
    private Collection $vtkCustomersAsks;

    /**
     * @var Collection<int, VtkDocument>
     */
    #[ORM\OneToMany(targetEntity: VtkDocument::class, mappedBy: 'customer')]
    private Collection $documents;

    public function __construct()
    {
        $this->vtkContacts = new ArrayCollection();
        $this->vtkCustomersAsks = new ArrayCollection();
        $this->documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): static
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

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
     * @return Collection<int, VtkContact>
     */
    public function getVtkContacts(): Collection
    {
        return $this->vtkContacts;
    }

    public function addVtkContact(VtkContact $vtkContact): static
    {
        if (!$this->vtkContacts->contains($vtkContact)) {
            $this->vtkContacts->add($vtkContact);
            $vtkContact->setCustomer($this);
        }

        return $this;
    }

    public function removeVtkContact(VtkContact $vtkContact): static
    {
        if ($this->vtkContacts->removeElement($vtkContact)) {
            // set the owning side to null (unless already changed)
            if ($vtkContact->getCustomer() === $this) {
                $vtkContact->setCustomer(null);
            }
        }

        return $this;
    }

    public function getPrimaryContact(): ?VtkContact
    {
        return $this->primaryContact;
    }

    public function setPrimaryContact(?VtkContact $primaryContact): static
    {
        $this->primaryContact = $primaryContact;

        return $this;
    }

    /**
     * @return Collection<int, VtkCustomersAsk>
     */
    public function getVtkCustomersAsks(): Collection
    {
        return $this->vtkCustomersAsks;
    }

    public function addVtkCustomersAsk(VtkCustomersAsk $vtkCustomersAsk): static
    {
        if (!$this->vtkCustomersAsks->contains($vtkCustomersAsk)) {
            $this->vtkCustomersAsks->add($vtkCustomersAsk);
            $vtkCustomersAsk->setCustomer($this);
        }

        return $this;
    }

    public function removeVtkCustomersAsk(VtkCustomersAsk $vtkCustomersAsk): static
    {
        if ($this->vtkCustomersAsks->removeElement($vtkCustomersAsk)) {
            // set the owning side to null (unless already changed)
            if ($vtkCustomersAsk->getCustomer() === $this) {
                $vtkCustomersAsk->setCustomer(null);
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
            $document->setCustomer($this);
        }

        return $this;
    }

    public function removeDocument(VtkDocument $document): static
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getCustomer() === $this) {
                $document->setCustomer(null);
            }
        }

        return $this;
    }
}
