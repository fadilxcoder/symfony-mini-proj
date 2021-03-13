<?php

namespace App\Controller;

use App\Entity\Vehicules;
use App\Services\VehiclesServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehicleController extends AbstractController
{
    /**
     * @var VehiclesServices
     */
    private $vehiclesServices;

    public function __construct(VehiclesServices $vehiclesServices)
    {
        $this->vehiclesServices = $vehiclesServices;
    }

    /**
     * @Route("/vehicle/{id}/{slug}", name="vehicle")
     */
    public function index(Vehicules $vehicule): Response
    {
        try 
        {
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
