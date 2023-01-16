<?php
// api/src/EventSubscriber/EventMailSubscriber.php

// namespace App\EventSubscriber;

// use ApiPlatform\Symfony\EventListener\EventPriorities;
// use App\Entity\User;
// use Symfony\Component\EventDispatcher\EventSubscriberInterface;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpKernel\Event\ViewEvent;
// use Symfony\Component\HttpKernel\KernelEvents;
// use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

// final class EventMailSubscriber implements EventSubscriberInterface
// {

//     private UserPasswordHasherInterface $hasher;

//     public function __construct(UserPasswordHasherInterface $hasher)
//     {
//         $this->hasher = $hasher;
//     }

//     public static function getSubscribedEvents()
//     {
//         return [
//             KernelEvents::VIEW => ['hashPassword', EventPriorities::PRE_WRITE],
//         ];
//     }

//     public function hashPassword(ViewEvent $event): void
//     {
//         $user = $event->getControllerResult();
//         $method = $event->getRequest()->getMethod();
//         if (!$user instanceof User || Request::METHOD_POST !== $method) {
//             return;
//         }
//         $password = $this->hasher->hashPassword($user, $user->getPassword());
//         $user->setPassword($password);
//     }
// }
