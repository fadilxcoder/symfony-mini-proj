<?php

namespace App\Controller;

use App\Entity\Vehicules;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehicleController extends AbstractController
{
    /**
     * @Route("/vehicle/{id}/{slug}", name="vehicle")
     */
    public function index(Vehicules $vehicule): Response
    {
        try {
            dump($vehicule);
            
            return $this->render('vehicle/index.html.twig', [
                'controller_name' => 'VehicleController',
            ]);
        } catch(\Exception $e) {
            throw $this->createNotFoundException('Not found !');
        }
    }
}
