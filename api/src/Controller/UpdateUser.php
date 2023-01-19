<?php
namespace App\Controller;

use App\Entity\User;
use App\Entity\MyUserinfo;
use App\Service\UserService;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\Persistence\ManagerRegistry;

#[AsController]
class UpdateUser extends AbstractController
{
    private $token;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        private RequestStack $requestStack,
        private ManagerRegistry $managerRegistry
        ){
        $this->token = $tokenStorage;
    }

    public function __invoke()
    {
        $user = $this->token->getToken()->getUser();
        $request = $this->requestStack->getCurrentRequest();
        
        $firtName = json_decode($request->getContent())->firstName;
        $lastName = json_decode($request->getContent())->lastName;
        $address = json_decode($request->getContent())->address;
        $city = json_decode($request->getContent())->city;
        $postalCode = json_decode($request->getContent())->postalcode;
        $country = json_decode($request->getContent())->country;


        $em = $this->managerRegistry->getManager();
        

        $user->setFirstName($firtName);
        $user->setLastName($lastName);
        $user->setAddress($address);
        $user->setCity($city);
        $user->setPostalCode($postalCode);
        $user->setCountry($country);

        $em->flush();
        return $this->json($user);
    }
}