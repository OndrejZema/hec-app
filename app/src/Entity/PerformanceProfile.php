<?php

namespace App\Entity;

use App\Enum\ProfileTypeEnum;
use App\Repository\PerformanceProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: PerformanceProfileRepository::class)]
class PerformanceProfile
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'performanceProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'performanceProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?House $house = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(enumType: ProfileTypeEnum::class)]
    private ?ProfileTypeEnum $type = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $performanceIndex = null;

    #[ORM\Column]
    private array $profileDay = [];

    #[ORM\Column]
    private array $profileWeek = [];

    #[ORM\Column]
    private array $profileMonth = [];

    #[ORM\Column]
    private array $profileYear = [];

    /**
     * @var Collection<int, HousePerformanceProfile>
     */
    #[ORM\OneToMany(targetEntity: HousePerformanceProfile::class, mappedBy: 'performanceProfile')]
    private Collection $housePerformanceProfiles;

    public function __construct()
    {
        $this->housePerformanceProfiles = new ArrayCollection();
    }

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

    public function getName(): ?string
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

    public function getType(): ?ProfileTypeEnum
    {
        return $this->type;
    }

    public function setType(ProfileTypeEnum $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPerformanceIndex(): ?int
    {
        return $this->performanceIndex;
    }

    public function setPerformanceIndex(int $performanceIndex): static
    {
        $this->performanceIndex = $performanceIndex;

        return $this;
    }

    public function getProfileDay(): array
    {
        return $this->profileDay;
    }

    public function setProfileDay(array $profileDay): static
    {
        $this->profileDay = $profileDay;

        return $this;
    }

    public function getProfileWeek(): array
    {
        return $this->profileWeek;
    }

    public function setProfileWeek(array $profileWeek): static
    {
        $this->profileWeek = $profileWeek;

        return $this;
    }

    public function getProfileMonth(): array
    {
        return $this->profileMonth;
    }

    public function setProfileMonth(array $profileMonth): static
    {
        $this->profileMonth = $profileMonth;

        return $this;
    }

    public function getProfileYear(): array
    {
        return $this->profileYear;
    }

    public function setProfileYear(array $profileYear): static
    {
        $this->profileYear = $profileYear;

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
            $housePerformanceProfile->setPerformanceProfile($this);
        }

        return $this;
    }

    public function removeHousePerformanceProfile(HousePerformanceProfile $housePerformanceProfile): static
    {
        if ($this->housePerformanceProfiles->removeElement($housePerformanceProfile)) {
            // set the owning side to null (unless already changed)
            if ($housePerformanceProfile->getPerformanceProfile() === $this) {
                $housePerformanceProfile->setPerformanceProfile(null);
            }
        }

        return $this;
    }

}
