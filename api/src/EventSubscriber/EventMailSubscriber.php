<?php

namespace App\EventSubscriber;

use App\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use ApiPlatform\Symfony\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class EventMailSubscriber implements EventSubscriberInterface
{
   /* private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
*/
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['sendMail', EventPriorities::POST_WRITE],
        ];
    }

    public function sendMail(GetResponseForControllerResultEvent $resultEvent)
    {
        $event = $resultEvent->getControllerResult();
        $method = $resultEvent->getRequest()->getMethod();

        if (!$event instanceof Event || Request::METHOD_POST !== $method) {
            return;
        }
        dump($event);
        /*foreach ($event->getHackathon()->getParticipants() as $user) {
            $message = (new \Swift_Message('New event'))
            ->setFrom($event->getHackathon()->getOwner()->getEmail())
            ->setTo($user->getEmail())
            ->setBody(sprintf('New event is comming', $event->getId()));

            $this->mailer->send($message);
        }*/
    }
}