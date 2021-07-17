<?php


namespace App\EventSubscriber\Events;

use App\Entity\Vehicules;
use Symfony\Contracts\EventDispatcher\Event;

class VehicleEvent extends Event
{
    /**
     * @var Vehicules
     */
    private $vehicule;

    public function __construct(Vehicules $vehicule)
    {
        $this->vehicule = $vehicule;
    }

    public function getVehicle() : Vehicules
    {
        return $this->vehicule;
    }
}