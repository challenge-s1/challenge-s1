<?php
// api/src/EventSubscriber/BookMailSubscriber.php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\MasterClass;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\Persistence\ManagerRegistry;

final class UpdateMasterClassSubscriber implements EventSubscriberInterface
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
        $masterClass = $event->getControllerResult();

        $method = $event->getRequest()->getMethod();

        if (!$masterClass instanceof MasterClass || Request::METHOD_PUT !== $method) {
            return;
        }
        $em = $this->managerRegistry->getManager();
        $reservations = $masterClass->getReservations();
        foreach ($reservations as $reservation) {
            $user = $reservation->getUserId();
            $message = (new Email())
                ->from('no.reply.lets.bake@gmail.com')
                ->to($user->getEmail())
                ->subject('MasterClass informations updated')
                ->html('<p>The Master class' . ' ' . $masterClass->getTitle() . '' . 'was updated
                    <p>date : ' . $masterClass->getDate()->format('d/m/y') . '</p>
                    <p>time : ' . $masterClass->getTime()->format('H:m') . '</p>
                    <p>location : ' . $masterClass->getAdress() . ', ' . $masterClass->getPostalcode() . ' ' . $masterClass->getCity() . ' ' . $masterClass->getCountry() . '</p>
                    </p>');
            $this->mailer->send($message);
        }
    }
}
