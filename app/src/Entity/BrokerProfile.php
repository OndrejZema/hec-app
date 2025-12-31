<?php

namespace App\Entity;

use App\Repository\BrokerProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: BrokerProfileRepository::class)]
class BrokerProfile
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'brokerProfiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private array $purchaseProfileDay = [];

    #[ORM\Column]
    private array $purchaseProfileWeek = [];

    #[ORM\Column]
    private array $purchaseProfileMonth = [];

    #[ORM\Column]
    private array $purchaseProfileYear = [];

    #[ORM\Column]
    private array $saleProfileDay = [];

    #[ORM\Column]
    private array $saleProfileWeek = [];

    #[ORM\Column]
    private array $saleProfileMonth = [];

    #[ORM\Column]
    private array $saleProfileYear = [];

    /**
     * @var Collection<int, HouseBrokerProfile>
     */
    #[ORM\OneToMany(targetEntity: HouseBrokerProfile::class, mappedBy: 'brokerProfile')]
    private Collection $houseBrokerProfiles;

    public function __construct()
    {
        $this->houseBrokerProfiles = new ArrayCollection();
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

    public function getPurchaseProfileDay(): array
    {
        return $this->purchaseProfileDay;
    }

    public function setPurchaseProfileDay(array $purchaseProfileDay): static
    {
        $this->purchaseProfileDay = $purchaseProfileDay;

        return $this;
    }

    public function getPurchaseProfileWeek(): array
    {
        return $this->purchaseProfileWeek;
    }

    public function setPurchaseProfileWeek(array $purchaseProfileWeek): static
    {
        $this->purchaseProfileWeek = $purchaseProfileWeek;

        return $this;
    }

    public function getPurchaseProfileMonth(): array
    {
        return $this->purchaseProfileMonth;
    }

    public function setPurchaseProfileMonth(array $purchaseProfileMonth): static
    {
        $this->purchaseProfileMonth = $purchaseProfileMonth;

        return $this;
    }

    public function getPurchaseProfileYear(): array
    {
        return $this->purchaseProfileYear;
    }

    public function setPurchaseProfileYear(array $purchaseProfileYear): static
    {
        $this->purchaseProfileYear = $purchaseProfileYear;

        return $this;
    }

    public function getSaleProfileDay(): array
    {
        return $this->saleProfileDay;
    }

    public function setSaleProfileDay(array $saleProfileDay): static
    {
        $this->saleProfileDay = $saleProfileDay;

        return $this;
    }

    public function getSaleProfileWeek(): array
    {
        return $this->saleProfileWeek;
    }

    public function setSaleProfileWeek(array $saleProfileWeek): static
    {
        $this->saleProfileWeek = $saleProfileWeek;

        return $this;
    }

    public function getSaleProfileMonth(): array
    {
        return $this->saleProfileMonth;
    }

    public function setSaleProfileMonth(array $saleProfileMonth): static
    {
        $this->saleProfileMonth = $saleProfileMonth;

        return $this;
    }

    public function getSaleProfileYear(): array
    {
        return $this->saleProfileYear;
    }

    public function setSaleProfileYear(array $saleProfileYear): static
    {
        $this->saleProfileYear = $saleProfileYear;

        return $this;
    }

    /**
     * @return Collection<int, HouseBrokerProfile>
     */
    public function getHouseBrokerProfiles(): Collection
    {
        return $this->houseBrokerProfiles;
    }

    public function addHouseBrokerProfile(HouseBrokerProfile $houseBrokerProfile): static
    {
        if (!$this->houseBrokerProfiles->contains($houseBrokerProfile)) {
            $this->houseBrokerProfiles->add($houseBrokerProfile);
            $houseBrokerProfile->setBrokerProfile($this);
        }

        return $this;
    }

    public function removeHouseBrokerProfile(HouseBrokerProfile $houseBrokerProfile): static
    {
        if ($this->houseBrokerProfiles->removeElement($houseBrokerProfile)) {
            // set the owning side to null (unless already changed)
            if ($houseBrokerProfile->getBrokerProfile() === $this) {
                $houseBrokerProfile->setBrokerProfile(null);
            }
        }

        return $this;
    }
}
