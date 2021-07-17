<?php

namespace App\Controller;

use App\Entity\Vehicules;
use App\EventSubscriber\Events;
use App\EventSubscriber\Events\VehicleEvent;
use App\Services\VehiclesServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehicleController extends AbstractController
{
    /**
     * @var VehiclesServices
     */
    private $vehiclesServices;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(
        VehiclesServices $vehiclesServices,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->vehiclesServices = $vehiclesServices;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @Route("/vehicle/{id}/{slug}", name="vehicle")
     */
    public function index(Vehicules $vehicule): Response
    {
        try 
        {
            $this->eventDispatcher->dispatch(new VehicleEvent($vehicule), Events::VEHICLES_CLICKED);

            return $this->render('vehicle/index.html.twig', [
                'vehicule' => $vehicule,
                'specifications' => $this->vehiclesServices->getRandomSpecifications(),
            ]);
        } 
        catch(\Exception $e) 
        {
            throw $this->createNotFoundException('Not found !');
        }
    }
}
