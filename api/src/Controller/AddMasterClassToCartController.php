<?php

namespace App\Controller;

use App\Entity\MasterClass;
use App\Entity\Cart;
use App\Repository\CartRepository;
use App\Repository\ReservationRepository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[AsController]
class AddMasterClassToCartController extends AbstractController
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

        $masterClass = $this->entityManager->getRepository(MasterClass::class)->find($request->get('mId'));
        $nbReservation = $this->reservationRepository->getNbReservationByMasterClass($masterClass->getId());
        $nbInCart = $this->cartRepository->getNbInCartByMasterClass($masterClass);
        if ($nbReservation + $nbInCart >= $masterClass->getMaxNumber()) {
            return $this->json("full");
        } else {
            $cart = $this->cartRepository->findOneBy(array('client' => $user, 'masterClass' => $masterClass));
            if ($cart !== null) {
                $cart->setQuantity($cart->getQuantity() + 1);
                
            } else {
                $newcart = new Cart();
                $newcart->setClient($user);
                $newcart->setMasterClass($masterClass);
                $newcart->setQuantity(1);
                $this->entityManager->persist($newcart);
            }
            $this->entityManager->flush();
            return $this->json("Added to cart");
        }
        
        
        
    }
}
