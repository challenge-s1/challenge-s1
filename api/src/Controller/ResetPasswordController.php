<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;

#[AsController]
class ResetPasswordController extends AbstractController
{ 
    public function __construct(
        private RequestStack $requestStack,
        private ManagerRegistry $managerRegistry){}

    public function __invoke()
    {
        $request = $this->requestStack->getCurrentRequest();
        dump($request);
        //TODO: test email
        
        $email = json_decode($request->getContent())->email;
        dump($email);
        if ( $user = $this->managerRegistry->getRepository(User::class)->findOneBy(['email' => $email]) ) {
            return $this->createNotFoundException();
        }
        $user->setToken(bin2hex(random_bytes(32)));
        $this->managerRegistry->getManager()->flush();
        return $this->json($email);
       //$resetToken = $this->resetPasswordHelper->generateResetToken($user);
    

        /*$email = (new TemplatedEmail())
            ->from(new Address('no-reply@example.com', 'Password reset'))
            ->to($user->getEmail())
            ->subject('Your password reset request')
            ->setBody(sprintf('reset Token: ', $resetToken));

        $this->mailer->send($email);*/


        //return $user;
    }
}