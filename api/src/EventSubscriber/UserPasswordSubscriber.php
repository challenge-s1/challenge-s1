<?php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities as EventListenerEventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class UserPasswordSubscriber implements EventSubscriberInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function cryptPassword(ViewEvent $event)
    {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($entity instanceof User && ($method == Request::METHOD_POST || $method == Request::METHOD_PUT)) {
            $entity->setPassword($this->passwordEncoder->hashPassword(
                $entity,
                $entity->getPassword()
            ));
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.view' => ['cryptPassword', EventListenerEventPriorities::PRE_VALIDATE],
        ];
    }
}
