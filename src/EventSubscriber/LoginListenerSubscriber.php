<?php

namespace App\EventSubscriber;

use App\Mailer\AuthMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginListenerSubscriber implements EventSubscriberInterface
{
    private $em, $authMailer;

    public function __construct(EntityManagerInterface $em, AuthMailer $authMailer)
    {
        $this->em = $em;
        $this->authMailer = $authMailer;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        $user->setLastLoginAt(new \DateTime());
        $this->em->persist($user);
        $this->em->flush();
        $this->authMailer->dispatchEmail($user);
    }

    public static function getSubscribedEvents()
    {
        return [
            'security.interactive_login' => 'onSecurityInteractiveLogin',
        ];
    }
}
