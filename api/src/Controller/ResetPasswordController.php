<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

// use Symfony\Component\Mime\Email;


#[AsController]
class ResetPasswordController extends AbstractController
{
    private $mailer;
    public function __construct(
        private RequestStack $requestStack,
        private ManagerRegistry $managerRegistry,
        MailerInterface $mailer
    ) {
        $this->mailer = $mailer;
    }

    public function __invoke()
    {
        $request = $this->requestStack->getCurrentRequest();
        // TODO: test email
        $email = json_decode($request->getContent())->email;

        $em = $this->managerRegistry->getManager();
        /** @var User $user */
        if (!$user = $em->getRepository(User::class)->findOneBy(['email' => $email])) {
            return $this->createNotFoundException();
        }

        $user->setToken(bin2hex(random_bytes(32)));
        $em->flush();

        // TODO: send Email

        $emailSend = (new Email())
            ->from('no.reply.lets.bake@gmail.com')
            ->to($user->getEmail())
            ->subject('Reset Password')

            // ->html('Click <a href="http://localhost:8000/reset-password/' . $user->getToken() . '">here for reset your password</a>');
            ->html('Click <a href="https://comforting-torte-f8b9e5.netlify.app/reset-password/' . $user->getToken() . '">here for reset your password</a>');

        $this->mailer->send($emailSend);

        return $this->json($email);
    }
}
