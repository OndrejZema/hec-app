<?php

namespace App\Entity;

use App\Repository\HouseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: HouseRepository::class)]
class House
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'houses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, HouseVisit>
     */
    #[ORM\OneToMany(targetEntity: HouseVisit::class, mappedBy: 'house')]
    private Collection $houseVisits;

    public function __construct()
    {
        $this->houseVisits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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

    /**
     * @return Collection<int, HouseVisit>
     */
    public function getHouseVisits(): Collection
    {
        return $this->houseVisits;
    }

    public function addHouseVisit(HouseVisit $houseVisit): static
    {
        if (!$this->houseVisits->contains($houseVisit)) {
            $this->houseVisits->add($houseVisit);
            $houseVisit->setHouse($this);
        }

        return $this;
    }

    public function removeHouseVisit(HouseVisit $houseVisit): static
    {
        if ($this->houseVisits->removeElement($houseVisit)) {
            // set the owning side to null (unless already changed)
            if ($houseVisit->getHouse() === $this) {
                $houseVisit->setHouse(null);
            }
        }

        return $this;
    }
}
