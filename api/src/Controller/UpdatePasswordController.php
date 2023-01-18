<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

// use Symfony\Component\Mime\Email;


#[AsController]
class UpdatePasswordController extends AbstractController
{

    public function __construct(
        private RequestStack $requestStack,
        private ManagerRegistry $managerRegistry,
        private readonly UserPasswordHasherInterface $passwordHasher

    ) {
    }

    public function __invoke()
    {
        $request = $this->requestStack->getCurrentRequest();
        // TODO: test email
        // $token = $request->attributes->get('id');
        // var_dump($token);
        $token = json_decode($request->getContent())->token;
        $password = json_decode($request->getContent())->password;

        $em = $this->managerRegistry->getManager();
        /** @var User $user */
        if (!$user = $em->getRepository(User::class)->findOneBy(['token' => $token])) {
            return $this->createNotFoundException();
        }
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $password
        );

        $user->setPassword($hashedPassword);
        $em->flush();

        // TODO: send Email

        return $this->json($user->getPassword());
    }
}
