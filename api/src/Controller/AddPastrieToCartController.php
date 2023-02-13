<?php

namespace App\Controller;

use App\Entity\Pastrie;
use App\Entity\Cart;
use App\Repository\CartRepository;
use App\Repository\ReservationRepository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[AsController]
class AddPastrieToCartController extends AbstractController
{

    public function __construct(
        private RequestStack $requestStack,
        private ManagerRegistry $managerRegistry,
        private EntityManagerInterface $entityManager,
        private CartRepository $cartRepository,
        private ReservationRepository $reservationRepository
        
    ) {
    }

    public function __invoke()
    {
        $request = $this->requestStack->getCurrentRequest();

        $user = $this->getUser();

        $pastrie = $this->entityManager->getRepository(Pastrie::class)->find($request->get('pId'));
        
        $cart = $this->cartRepository->findOneBy(array('client' => $user, 'cake' => $pastrie));
        if ($cart !== null) {
            $cart->setQuantity($cart->getQuantity() + 1);
            

        } else {
                $cart = new Cart();
                $cart->setClient($user);
                $cart->setCake($pastrie);
                $cart->setQuantity(1);
                $this->entityManager->persist($cart);
        }
        $this->entityManager->flush();
        return $this->json("Added to cart");
        
        
        
        
    }
}
