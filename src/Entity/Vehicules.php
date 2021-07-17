<?php

namespace App\Entity;

use App\Repository\VehiculesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass=VehiculesRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Vehicules
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gearBox;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pricePerDay;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="text")
     */
    private $additionalDetails;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDisplayed;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fuel;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="vehicules")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=VehiculesStats::class, mappedBy="vehicules")
     */
    private $vehiculesStats;

    public function __construct()
    {
        $this->vehiculesStats = new ArrayCollection();
    }

    /**
     * Init the slug of vehicule by name
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initSlug()
    {
        if (empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->name);
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getGearBox(): ?string
    {
        return $this->gearBox;
    }

    public function setGearBox(string $gearBox): self
    {
        $this->gearBox = $gearBox;

        return $this;
    }

    public function getPricePerDay(): ?string
    {
        return $this->pricePerDay;
    }

    public function setPricePerDay(string $pricePerDay): self
    {
        $this->pricePerDay = $pricePerDay;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAdditionalDetails(): ?string
    {
        return $this->additionalDetails;
    }

    public function setAdditionalDetails(string $additionalDetails): self
    {
        $this->additionalDetails = $additionalDetails;

        return $this;
    }

    public function getIsDisplayed(): ?bool
    {
        return $this->isDisplayed;
    }

    public function setIsDisplayed(?bool $isDisplayed): self
    {
        $this->isDisplayed = $isDisplayed;

        return $this;
    }

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): self
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|VehiculesStats[]
     */
    public function getVehiculesStats(): Collection
    {
        return $this->vehiculesStats;
    }

    public function addVehiculesStat(VehiculesStats $vehiculesStat): self
    {
        if (!$this->vehiculesStats->contains($vehiculesStat)) {
            $this->vehiculesStats[] = $vehiculesStat;
            $vehiculesStat->setVehicules($this);
        }

        return $this;
    }

    public function removeVehiculesStat(VehiculesStats $vehiculesStat): self
    {
        if ($this->vehiculesStats->removeElement($vehiculesStat)) {
            // set the owning side to null (unless already changed)
            if ($vehiculesStat->getVehicules() === $this) {
                $vehiculesStat->setVehicules(null);
            }
        }

        return $this;
    }
}
