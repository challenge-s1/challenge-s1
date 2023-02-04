<?php

namespace App\DataFixtures;

use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\MasterClassFixtures;
use App\Entity\MasterClass;
use App\Entity\User;

class ReservationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $user = array_filter($manager->getRepository(User::class)->findAll(), function ($user) {
            return in_array('ROLE_USER', $user->getRoles());
        });
        $masterClasses = $manager->getRepository(MasterClass::class)->findAll();
        for ($i = 1; $i <= 10; $i++) {
            $reservation = new Reservation();
            $reservation->setUserId($faker->randomElement($user));
            $masterClass = $faker->randomElement($masterClasses);
            $reservation->setMasterClass($masterClass);
            $reservation->setNbPlaces($faker->numberBetween(1, $masterClass->getMaxNumber()));
            $reservation->setPrice($reservation->getNbPlaces() * $masterClass->getPrice());
            $manager->persist($reservation);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            // Load MasterClassFixtures before ReservationFixtures
            MasterClassFixtures::class,
            // Load UserFixtures before ReservationFixtures
            UserFixtures::class
        ];
    }
}
