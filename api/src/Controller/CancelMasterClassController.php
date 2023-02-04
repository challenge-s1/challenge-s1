<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\VoucherDiscount;
use App\Repository\MasterClassRepository;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

// use Symfony\Component\Mime\Email;


#[AsController]
class CancelMasterClassController extends AbstractController
{
    private $mailer;
    public function __construct(
        private RequestStack $requestStack,
        private ManagerRegistry $managerRegistry,
        MailerInterface $mailer
    ) {
        $this->mailer = $mailer;
    }

    public function __invoke($id, ReservationRepository $reservationRepository, UserRepository $userRepository, MasterClassRepository $masterClassRepository)
    {
        $reservations = $reservationRepository->findByMasterClassField($id);
        $masterClass  = $masterClassRepository->find($id);
        $masterClass->setIsCanceled(true);
        // return $this->json($reservations);
        $em = $this->managerRegistry->getManager();
        foreach ($reservations as $reservation) {
            $user = $userRepository->findOneBy(['email' => $reservation["email"]]);
            $VoucherDiscount = new VoucherDiscount();
            $VoucherDiscount->setOwner($user);
            $VoucherDiscount->setPrice($reservation["price"]);
            $em->persist($VoucherDiscount);
            $emailSend = (new Email())
                ->from('no-reply@gmail.com')
                ->to($user->getEmail())
                ->subject('Annulation de votre réservation')
                // ->htmlTemplate('emails/cancel_reservation.html.twig', [
                //     'price' => $reservation["price"],
                //     'title' => $reservation["title"]
                // ]);
                ->html('<p>la master class ' . $reservation["title"] . ' a été annulé, vous avez reçu un bon de réduction de ' . $reservation["price"] . '€</p>');
            $this->mailer->send($emailSend);
        }
        $em->flush();
        return $this->json($masterClass);

        // $reservation = $reservationRepository->find($id);
        // $em = $this->managerRegistry->getManager();
        // $em->remove($reservation);

        // return $this->json($id);


        // $request = $this->requestStack->getCurrentRequest();
        // $id = json_decode($request->getContent())->id;
        // return $this->json($id);
        // // TODO: test email
        // $email = json_decode($request->getContent())->email;

        // $em = $this->managerRegistry->getManager();
        // /** @var User $user */
        // if (!$user = $em->getRepository(User::class)->findOneBy(['email' => $email])) {
        //     return $this->createNotFoundException();
        // }

        // $user->setToken(bin2hex(random_bytes(32)));
        // $em->flush();

        // // TODO: send Email





        // return $this->json($email);

    }
}
