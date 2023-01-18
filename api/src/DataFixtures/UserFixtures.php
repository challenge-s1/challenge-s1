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
            $user->setRoles(['ROLE_USER']);
            $user->setIsActive(true);
            $user->setFirstName('User' . $i);
            $user->setLastName('User' . $i);
            $user->setAddress('Address' . $i);
            $user->setCity('City' . $i);
            $user->setPostalCode($i);
            $user->setCountry('Paris');
            $manager->persist($user);
        }
        $admin = new User();
        $admin->setEmail('admin@gmail.com');
        $password = $this->hasher->hashPassword($admin, 'test');
        $admin->setPassword($password);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setIsActive(true);
        $admin->setFirstName('Admin');
        $admin->setLastName('Admin');
        $admin->setAddress('Address');
        $admin->setCity('City');
        $admin->setPostalCode(1);
        $admin->setCountry('Paris');
        $manager->persist($admin);

        for ($i = 1; $i < 5; $i++) {
            $patissier = new User();
            $patissier->setEmail('patissier' . $i . '@gmail.com');
            $password = $this->hasher->hashPassword($patissier, 'test');
            $patissier->setPassword($password);
            $patissier->setRoles(['ROLE_PATISSIER']);
            $patissier->setIsActive(true);
            $patissier->setFirstName('Patissier' . $i);
            $patissier->setLastName('Patissier' . $i);
            $patissier->setAddress('Address' . $i);
            $patissier->setCity('City' . $i);
            $patissier->setPostalCode($i);
            $patissier->setCountry('Paris');
            $manager->persist($patissier);
        }



        $manager->flush();
    }
}
