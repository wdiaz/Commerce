<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MerchantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: MerchantRepository::class)]
#[ApiResource]
class Merchant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(type: Types::GUID, unique: true)]
    private ?string $uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'string', unique: true, nullable: false)]
    #[Gedmo\Slug(fields: ['name'])]
    private ?string $slug = null;

    #[ORM\Column]
    private ?float $locationX = null;

    #[ORM\Column]
    private ?float $locationY = null;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getLocationX(): ?float
    {
        return $this->locationX;
    }

    public function setLocationX(float $locationX): static
    {
        $this->locationX = $locationX;

        return $this;
    }

    public function getLocationY(): ?float
    {
        return $this->locationY;
    }

    public function setLocationY(float $locationY): static
    {
        $this->locationY = $locationY;

        return $this;
    }
}
