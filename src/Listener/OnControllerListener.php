<?php

namespace App\Listener;

use App\Controller\VehicleController;
use App\Repository\VehiculesRepository;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class OnControllerListener
{
    /**
     * @var VehiculesRepository
     */
    private $vehiculesRepository;

    public function __construct(VehiculesRepository $vehiculesRepository)
    {
        $this->vehiculesRepository = $vehiculesRepository;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        $controller = $controller[0];

        if ($controller instanceof VehicleController) {
            $route = $event->getRequest()->attributes->get('_route');

            if ($route == 'vehicle') {
                $id = $event->getRequest()->attributes->get('id');
                $slug = $event->getRequest()->attributes->get('slug');
                $isValid = $this->vehiculesRepository->findOneBy([
                    'id' => $id,
                    'isDisplayed' => true,
                    'slug' => $slug
                ]);

                if (!(bool)$isValid) {
                    throw new AccessDeniedHttpException();
                }

                return;
            }
        }
    }
}
