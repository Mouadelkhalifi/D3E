<?php

namespace App\Entity;

use App\Repository\VtkDocumentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VtkDocumentRepository::class)]
class VtkDocument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fileName = null;

    #[ORM\Column(length: 100)]
    private ?string $fileType = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $fileUrl = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $uploadedAt = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    private ?VtkCustomersAsk $ask = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    private ?VtkMaterialsLot $lot = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    private ?VtkCustomer $customer = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    private ?VtkUser $uploadedBy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): static
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getFileType(): ?string
    {
        return $this->fileType;
    }

    public function setFileType(string $fileType): static
    {
        $this->fileType = $fileType;

        return $this;
    }

    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    public function setFileUrl(string $fileUrl): static
    {
        $this->fileUrl = $fileUrl;

        return $this;
    }

    public function getUploadedAt(): ?\DateTimeImmutable
    {
        return $this->uploadedAt;
    }

    public function setUploadedAt(\DateTimeImmutable $uploadedAt): static
    {
        $this->uploadedAt = $uploadedAt;

        return $this;
    }

    public function getAsk(): ?VtkCustomersAsk
    {
        return $this->ask;
    }

    public function setAsk(?VtkCustomersAsk $ask): static
    {
        $this->ask = $ask;

        return $this;
    }

    public function getLot(): ?VtkMaterialsLot
    {
        return $this->lot;
    }

    public function setLot(?VtkMaterialsLot $lot): static
    {
        $this->lot = $lot;

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

    public function getUploadedBy(): ?VtkUser
    {
        return $this->uploadedBy;
    }

    public function setUploadedBy(?VtkUser $uploadedBy): static
    {
        $this->uploadedBy = $uploadedBy;

        return $this;
    }
}
