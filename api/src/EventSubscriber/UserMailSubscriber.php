<?php
// api/src/EventSubscriber/BookMailSubscriber.php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\Persistence\ManagerRegistry;

final class UserMailSubscriber implements EventSubscriberInterface
{
    private $mailer;

    public function __construct(
        MailerInterface $mailer,
        private ManagerRegistry $managerRegistry
    ) {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['sendMail', EventPriorities::POST_WRITE],
        ];
    }

    public function sendMail(ViewEvent $event): void
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$user instanceof User || Request::METHOD_POST !== $method) {
            return;
        }
        $em = $this->managerRegistry->getManager();
        $user->setToken(bin2hex(random_bytes(32)));
        $em->flush();

        $message = (new Email())
            ->from('letsbake@gmail.com')
            ->to($user->getEmail())
            ->subject('Activate your account')
            ->html('Click on the link to activate your account <a href="http://localhost:8000/account/activate/' . $user->getToken() . '">HERE</a>')

            // ->text(sprintf('Click on the link', $user->getToken(), ' to activate your account'))
        ;

        $this->mailer->send($message);
    }
}
