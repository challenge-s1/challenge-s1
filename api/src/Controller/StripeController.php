<?php

namespace App\Controller;

use App\Entity\Ordered;
use App\Entity\Reservation;
use App\Repository\CartRepository;
use App\Repository\VoucherDiscountRepository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Stripe\Stripe;
use Stripe\Charge;

#[AsController]
class StripeController extends AbstractController
{

    public function __construct(
        private RequestStack $requestStack,
        private ManagerRegistry $managerRegistry,
        private EntityManagerInterface $entityManager,
        private CartRepository $cartRepository,
        private VoucherDiscountRepository $voucherRepository
    ) {
    }

    public function __invoke()
    {
        $request = $this->requestStack->getCurrentRequest();

        $user = $this->getUser();
        $carts = $this->cartRepository->findByUserId($user->getId());
        $amountMasterClass = $this->cartRepository->getAmountMasterClassByUserId($user->getId());
        $vouchers = $this->voucherRepository->findByUserId($user->getId());
        foreach ($vouchers as $voucher) {
            $rest = $voucher->getPrice() - $amountMasterClass;
            if ($rest > 0) {
                $amountMasterClass = $amountMasterClass - ($voucher->getPrice() - $rest);
                $voucher->setPrice($rest);
            } else {
                $amountMasterClass = $amountMasterClass - $voucher->getPrice();
                $this->entityManager->remove($voucher);
            }
        }
        $amountPastrie = $this->cartRepository->getAmountPastrieByUserId($user->getId());

        Stripe::setApiKey($_ENV["STRIPE_SECRET"]);
        Charge::create([
                "amount" => floatval($amountPastrie + $amountMasterClass) * 100,
                "currency" => "usd",
                "source" => json_decode($request->getContent())->stripeToken,
                "description" => "Payment For Let's bake"
        ]);
        foreach ($carts as $cart) {
            if ($cart->getMasterClass() !== null) {
                $reservation = new Reservation();
                $reservation->setUserId($user);
                $reservation->setMasterClass($cart->getMasterClass());
                $reservation->setNbPlaces($cart->getQuantity());
                $reservation->setPrice($cart->getMasterClass()->getPrice() * $cart->getQuantity());
                $this->entityManager->persist($reservation);
            } else {
                $order = new Ordered();
                $order->setOwner($user);
                $order->setPastrie($cart->getCake());
                $order->setQuantity($cart->getQuantity());
                $this->entityManager->persist($order);

            }
            
        }
        $this->entityManager->flush();
        $this->cartRepository->drainCartForUser($user->getId());
        return $this->json("Your payment has been accepted");
    }
}
