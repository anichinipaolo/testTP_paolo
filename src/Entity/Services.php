<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicesRepository::class)]
class Services
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $sname = null;

    #[ORM\Column(length: 255)]
    private ?string $sdescription = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getSname(): ?string
    {
        return $this->sname;
    }

    public function setSname(string $sname): static
    {
        $this->sname = $sname;

        return $this;
    }

    public function getSdescription(): ?string
    {
        return $this->sdescription;
    }

    public function setSdescription(string $sdescription): static
    {
        $this->sdescription = $sdescription;

        return $this;
    }
}
