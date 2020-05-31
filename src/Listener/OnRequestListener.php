<?php

namespace App\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class OnRequestListener
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var mixed
     */
    private $maintenance;

    /**
     * @var mixed
     */
    private $ipAuthorized;

    public function __construct(
        $maintenance,
        ContainerInterface $container
    ) {
        $this->container = $container;
        $this->maintenance = $maintenance['status'];
        $this->ipAuthorized = $maintenance['ipAuthorized'];
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $maintenance = $this->maintenance ? $this->maintenance : false;
        $currentIP = $_SERVER['REMOTE_ADDR'];

        if ($maintenance && !in_array($currentIP, $this->ipAuthorized)) {
            $twig = $this->container->get('twig');
            $template = $twig->render('bundles/TwigBundle/Exception/503.html.twig');

            return $event->setResponse(new Response($template, 503));
        }
    }
}
