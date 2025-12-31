<?php

namespace App\Entity;

use App\Repository\HouseBrokerProfileRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: HouseBrokerProfileRepository::class)]
class HouseBrokerProfile
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'houseBrokerProfiles')]
    private ?House $house = null;

    #[ORM\ManyToOne(inversedBy: 'houseBrokerProfiles')]
    private ?BrokerProfile $brokerProfile = null;

    #[ORM\Column]
    private bool $isActive = true;

    #[ORM\ManyToOne(inversedBy: 'houseBrokerProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBrokerProfile(): ?BrokerProfile
    {
        return $this->brokerProfile;
    }

    public function setBrokerProfile(?BrokerProfile $brokerProfile): static
    {
        $this->brokerProfile = $brokerProfile;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
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
}
