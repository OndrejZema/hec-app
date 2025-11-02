<?php

namespace App\Entity;

use App\Repository\HouseVisitRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: HouseVisitRepository::class)]
class HouseVisit
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'houseVisits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'houseVisits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?House $house = null;

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
}
