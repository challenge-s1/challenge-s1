<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 10; $i++) {
            $user = new User();
            $user->setEmail('user' . $i . '@gmail.com');
            $password = $this->hasher->hashPassword($user, 'test');
            $user->setPassword($password);
            $user->setFirstName('User' . $i);
            $user->setLastName('User' . $i);
            $user->setAddress('Address' . $i);
            $user->setCity('City' . $i);
            $user->setPostalCode($i);
            $user->setCountry('Paris');
            $manager->persist($user);
        }
        $manager->flush();
    }
}
