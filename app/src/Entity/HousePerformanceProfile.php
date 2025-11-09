<?php

namespace App\Entity;

use App\Repository\HousePerformanceProfileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HousePerformanceProfileRepository::class)]
class HousePerformanceProfile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'housePerformanceProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'housePerformanceProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?House $house = null;

    #[ORM\ManyToOne(inversedBy: 'housePerformanceProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PerformanceProfile $performanceProfile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getHouse(): ?House
    {
        return $this->house;
    }

    public function setHouse(?House $house): static
    {
        $this->house = $house;

        return $this;
    }

    public function getPerformanceProfile(): ?PerformanceProfile
    {
        return $this->performanceProfile;
    }

    public function setPerformanceProfile(?PerformanceProfile $performanceProfile): static
    {
        $this->performanceProfile = $performanceProfile;

        return $this;
    }
}
