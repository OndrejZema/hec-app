<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    private bool $isVerified = false;

    /**
     * @var Collection<int, House>
     */
    #[ORM\OneToMany(targetEntity: House::class, mappedBy: 'user')]
    private Collection $houses;

    /**
     * @var Collection<int, HouseVisit>
     */
    #[ORM\OneToMany(targetEntity: HouseVisit::class, mappedBy: 'user')]
    private Collection $houseVisits;

    /**
     * @var Collection<int, PerformanceProfile>
     */
    #[ORM\OneToMany(targetEntity: PerformanceProfile::class, mappedBy: 'user')]
    private Collection $performanceProfiles;

    /**
     * @var Collection<int, ConsumptionProfile>
     */
    #[ORM\OneToMany(targetEntity: ConsumptionProfile::class, mappedBy: 'user')]
    private Collection $consumptionProfiles;

    /**
     * @var Collection<int, HousePerformanceProfile>
     */
    #[ORM\OneToMany(targetEntity: HousePerformanceProfile::class, mappedBy: 'user')]
    private Collection $housePerformanceProfiles;

    /**
     * @var Collection<int, HouseConsumptionProfile>
     */
    #[ORM\OneToMany(targetEntity: HouseConsumptionProfile::class, mappedBy: 'user')]
    private Collection $houseConsumptionProfiles;

    /**
     * @var Collection<int, BrokerProfile>
     */
    #[ORM\OneToMany(targetEntity: BrokerProfile::class, mappedBy: 'user')]
    private Collection $brokerProfiles;

    /**
     * @var Collection<int, HouseBrokerProfile>
     */
    #[ORM\OneToMany(targetEntity: HouseBrokerProfile::class, mappedBy: 'user')]
    private Collection $houseBrokerProfiles;

    public function __construct()
    {
        $this->houses = new ArrayCollection();
        $this->houseVisits = new ArrayCollection();
        $this->performanceProfiles = new ArrayCollection();
        $this->consumptionProfiles = new ArrayCollection();
        $this->housePerformanceProfiles = new ArrayCollection();
        $this->houseConsumptionProfiles = new ArrayCollection();
        $this->brokerProfiles = new ArrayCollection();
        $this->houseBrokerProfiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
     */
    public function __serialize(): array
    {
        $data = (array)$this;
        $data["\0" . self::class . "\0password"] = hash('crc32c', $this->password);

        return $data;
    }

    #[\Deprecated]
    public function eraseCredentials(): void
    {
        // @deprecated, to be removed when upgrading to Symfony 8
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, House>
     */
    public function getHouses(): Collection
    {
        return $this->houses;
    }

    public function addHouse(House $house): static
    {
        if (!$this->houses->contains($house)) {
            $this->houses->add($house);
            $house->setUser($this);
        }

        return $this;
    }

    public function removeHouse(House $house): static
    {
        if ($this->houses->removeElement($house)) {
            // set the owning side to null (unless already changed)
            if ($house->getUser() === $this) {
                $house->setUser(null);
            }
        }

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
            $houseVisit->setUser($this);
        }

        return $this;
    }

    public function removeHouseVisit(HouseVisit $houseVisit): static
    {
        if ($this->houseVisits->removeElement($houseVisit)) {
            // set the owning side to null (unless already changed)
            if ($houseVisit->getUser() === $this) {
                $houseVisit->setUser(null);
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
            $performanceProfile->setUser($this);
        }

        return $this;
    }

    public function removePerformanceProfile(PerformanceProfile $performanceProfile): static
    {
        if ($this->performanceProfiles->removeElement($performanceProfile)) {
            // set the owning side to null (unless already changed)
            if ($performanceProfile->getUser() === $this) {
                $performanceProfile->setUser(null);
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
            $consumptionProfile->setUser($this);
        }

        return $this;
    }

    public function removeConsumptionProfile(ConsumptionProfile $consumptionProfile): static
    {
        if ($this->consumptionProfiles->removeElement($consumptionProfile)) {
            // set the owning side to null (unless already changed)
            if ($consumptionProfile->getUser() === $this) {
                $consumptionProfile->setUser(null);
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
            $housePerformanceProfile->setUser($this);
        }

        return $this;
    }

    public function removeHousePerformanceProfile(HousePerformanceProfile $housePerformanceProfile): static
    {
        if ($this->housePerformanceProfiles->removeElement($housePerformanceProfile)) {
            // set the owning side to null (unless already changed)
            if ($housePerformanceProfile->getUser() === $this) {
                $housePerformanceProfile->setUser(null);
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
            $houseConsumptionProfile->setUser($this);
        }

        return $this;
    }

    public function removeHouseConsumptionProfile(HouseConsumptionProfile $houseConsumptionProfile): static
    {
        if ($this->houseConsumptionProfiles->removeElement($houseConsumptionProfile)) {
            // set the owning side to null (unless already changed)
            if ($houseConsumptionProfile->getUser() === $this) {
                $houseConsumptionProfile->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BrokerProfile>
     */
    public function getBrokerProfiles(): Collection
    {
        return $this->brokerProfiles;
    }

    public function addBrokerProfile(BrokerProfile $brokerProfile): static
    {
        if (!$this->brokerProfiles->contains($brokerProfile)) {
            $this->brokerProfiles->add($brokerProfile);
            $brokerProfile->setUser($this);
        }

        return $this;
    }

    public function removeBrokerProfile(BrokerProfile $brokerProfile): static
    {
        if ($this->brokerProfiles->removeElement($brokerProfile)) {
            // set the owning side to null (unless already changed)
            if ($brokerProfile->getUser() === $this) {
                $brokerProfile->setUser(null);
            }
        }

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
            $houseBrokerProfile->setUser($this);
        }

        return $this;
    }

    public function removeHouseBrokerProfile(HouseBrokerProfile $houseBrokerProfile): static
    {
        if ($this->houseBrokerProfiles->removeElement($houseBrokerProfile)) {
            // set the owning side to null (unless already changed)
            if ($houseBrokerProfile->getUser() === $this) {
                $houseBrokerProfile->setUser(null);
            }
        }

        return $this;
    }


}
