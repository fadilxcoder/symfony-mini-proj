<?php

namespace App\EventSubscriber;

use App\Entity\VehiculesStats;
use App\EventSubscriber\Events\VehicleEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class AppSubscriber implements EventSubscriberInterface
{
    /**
     * @var Security
     */
    private $security;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param Security $security
     */
    public function __construct(
        Security $security,
        EntityManagerInterface $em
    ) {
        $this->security = $security;
        $this->em = $em;
    }

    public function onVehiclesClicked(VehicleEvent $event)
    {
        $stats = new VehiculesStats();
        $user = (null !== $this->security->getUser()) ? $this->security->getUser() : null;
        $vehicle = $event->getVehicle();
        $stats->setUser($user)->setVehicules($vehicle);
        $this->em->persist($stats);
        $this->em->flush();

    }

    public static function getSubscribedEvents()
    {
        return [
            Events::VEHICLES_CLICKED => [
                [
                    'onVehiclesClicked', 0 // Priority
                ], 
            ],
        ];
    }
}
