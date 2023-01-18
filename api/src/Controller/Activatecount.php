<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Mailer;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class Activatecount extends AbstractController
{
    public function __construct(
        private RequestStack $requestStack,
        private ManagerRegistry $managerRegistry,
    ) {
    }
    //activate account user after click on link in email with api platform
    public function __invoke(User $user, UserRepository $userRepository, Request $request): Response
    {
        $request = $this->requestStack->getCurrentRequest();
        // TODO: test email
        $token = json_decode($request->getContent())->token;

        // $token = $request->query->get('token');
        $em = $this->managerRegistry->getManager();
        $user = $userRepository->findOneBy(['token' => $token]);
        if (!$user) {
            // return $this->json(['message' => 'Account not activated']);
            return $this->createNotFoundException();
        }

        $user->setIsActive(true);
        $user->setToken(null);
        $em->persist($user);
        $em->flush();

        return $this->json(['message' => 'Account activated successfully']);
    }
}
