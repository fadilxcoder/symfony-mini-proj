<?php

namespace App\Entity;

use App\Repository\VehiculesStatsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehiculesStatsRepository::class)
 */
class VehiculesStats
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Vehicules::class, inversedBy="vehiculesStats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicules;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="vehiculesStats")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicules(): ?Vehicules
    {
        return $this->vehicules;
    }

    public function setVehicules(?Vehicules $vehicules): self
    {
        $this->vehicules = $vehicules;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
