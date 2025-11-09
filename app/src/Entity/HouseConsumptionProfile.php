<?php

namespace App\Entity;

use App\Repository\HouseConsumptionProfileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HouseConsumptionProfileRepository::class)]
class HouseConsumptionProfile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'houseConsumptionProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'houseConsumptionProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?House $house = null;

    #[ORM\ManyToOne(inversedBy: 'houseConsumptionProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ConsumptionProfile $consumptionProfile = null;

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

    public function getConsumptionProfile(): ?ConsumptionProfile
    {
        return $this->consumptionProfile;
    }

    public function setConsumptionProfile(?ConsumptionProfile $consumptionProfile): static
    {
        $this->consumptionProfile = $consumptionProfile;

        return $this;
    }
}
