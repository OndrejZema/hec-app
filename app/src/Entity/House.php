<?php

namespace App\Entity;

use App\Repository\HouseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: HouseRepository::class)]
#[ORM\Table(name: 'house', uniqueConstraints: [
    new ORM\UniqueConstraint(name: 'uniq_user_name', columns: ['user_id', 'name'])
])]
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

    /**
     * @var Collection<int, PerformanceProfile>
     */
    #[ORM\OneToMany(targetEntity: PerformanceProfile::class, mappedBy: 'house')]
    private Collection $performanceProfiles;

    /**
     * @var Collection<int, ConsumptionProfile>
     */
    #[ORM\OneToMany(targetEntity: ConsumptionProfile::class, mappedBy: 'house')]
    private Collection $consumptionProfiles;

    /**
     * @var Collection<int, HousePerformanceProfile>
     */
    #[ORM\OneToMany(targetEntity: HousePerformanceProfile::class, mappedBy: 'house')]
    private Collection $housePerformanceProfiles;

    /**
     * @var Collection<int, HouseConsumptionProfile>
     */
    #[ORM\OneToMany(targetEntity: HouseConsumptionProfile::class, mappedBy: 'house')]
    private Collection $houseConsumptionProfiles;

    public function __construct()
    {
        $this->houseVisits = new ArrayCollection();
        $this->performanceProfiles = new ArrayCollection();
        $this->consumptionProfiles = new ArrayCollection();
        $this->housePerformanceProfiles = new ArrayCollection();
        $this->houseConsumptionProfiles = new ArrayCollection();
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

    /**
     * @return Collection<int, PerformanceProfile>
     */
    public function getPerformanceProfiles(): Collection
    {
        return $this->performanceProfiles;
    }

    public function addPerformanceProfile(PerformanceProfile $performanceProfile): static
    {
        if (!$this->performanceProfiles->contains($performanceProfile)) {
            $this->performanceProfiles->add($performanceProfile);
            $performanceProfile->setHouse($this);
        }

        return $this;
    }

    public function removePerformanceProfile(PerformanceProfile $performanceProfile): static
    {
        if ($this->performanceProfiles->removeElement($performanceProfile)) {
            // set the owning side to null (unless already changed)
            if ($performanceProfile->getHouse() === $this) {
                $performanceProfile->setHouse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ConsumptionProfile>
     */
    public function getConsumptionProfiles(): Collection
    {
        return $this->consumptionProfiles;
    }

    public function addConsumptionProfile(ConsumptionProfile $consumptionProfile): static
    {
        if (!$this->consumptionProfiles->contains($consumptionProfile)) {
            $this->consumptionProfiles->add($consumptionProfile);
            $consumptionProfile->setHouse($this);
        }

        return $this;
    }

    public function removeConsumptionProfile(ConsumptionProfile $consumptionProfile): static
    {
        if ($this->consumptionProfiles->removeElement($consumptionProfile)) {
            // set the owning side to null (unless already changed)
            if ($consumptionProfile->getHouse() === $this) {
                $consumptionProfile->setHouse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, HousePerformanceProfile>
     */
    public function getHousePerformanceProfiles(): Collection
    {
        return $this->housePerformanceProfiles;
    }

    public function addHousePerformanceProfile(HousePerformanceProfile $housePerformanceProfile): static
    {
        if (!$this->housePerformanceProfiles->contains($housePerformanceProfile)) {
            $this->housePerformanceProfiles->add($housePerformanceProfile);
            $housePerformanceProfile->setHouse($this);
        }

        return $this;
    }

    public function removeHousePerformanceProfile(HousePerformanceProfile $housePerformanceProfile): static
    {
        if ($this->housePerformanceProfiles->removeElement($housePerformanceProfile)) {
            // set the owning side to null (unless already changed)
            if ($housePerformanceProfile->getHouse() === $this) {
                $housePerformanceProfile->setHouse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, HouseConsumptionProfile>
     */
    public function getHouseConsumptionProfiles(): Collection
    {
        return $this->houseConsumptionProfiles;
    }

    public function addHouseConsumptionProfile(HouseConsumptionProfile $houseConsumptionProfile): static
    {
        if (!$this->houseConsumptionProfiles->contains($houseConsumptionProfile)) {
            $this->houseConsumptionProfiles->add($houseConsumptionProfile);
            $houseConsumptionProfile->setHouse($this);
        }

        return $this;
    }

    public function removeHouseConsumptionProfile(HouseConsumptionProfile $houseConsumptionProfile): static
    {
        if ($this->houseConsumptionProfiles->removeElement($houseConsumptionProfile)) {
            // set the owning side to null (unless already changed)
            if ($houseConsumptionProfile->getHouse() === $this) {
                $houseConsumptionProfile->setHouse(null);
            }
        }

        return $this;
    }
}
