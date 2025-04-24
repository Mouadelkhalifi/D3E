<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VtkContactRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VtkContactRepository::class)]
#[ApiResource]
class VtkContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $fonction = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'vtkContacts')]
    private ?VtkCustomer $customer = null;

    #[ORM\OneToOne(mappedBy: 'primaryContact', cascade: ['persist', 'remove'])]
    private ?VtkCustomer $vtkCustomer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(?string $fonction): static
    {
        $this->fonction = $fonction;

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

    public function getVtkCustomer(): ?VtkCustomer
    {
        return $this->vtkCustomer;
    }

    public function setVtkCustomer(?VtkCustomer $vtkCustomer): static
    {
        // unset the owning side of the relation if necessary
        if ($vtkCustomer === null && $this->vtkCustomer !== null) {
            $this->vtkCustomer->setPrimaryContact(null);
        }

        // set the owning side of the relation if necessary
        if ($vtkCustomer !== null && $vtkCustomer->getPrimaryContact() !== $this) {
            $vtkCustomer->setPrimaryContact($this);
        }

        $this->vtkCustomer = $vtkCustomer;

        return $this;
    }
}
