<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Cart;
use App\Entity\User;
use App\Entity\Pastrie;
use App\Entity\MasterClass;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\MasterClassFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CartFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $user = array_filter($manager->getRepository(User::class)->findAll(), function ($user) {
            return in_array('ROLE_USER', $user->getRoles());
        });
        $masterClasses = $manager->getRepository(MasterClass::class)->findAll();
        $pastries = $manager->getRepository(Pastrie::class)->findAll();

        for ($i = 1; $i <= 10; $i++) {
            $cart = new Cart();
            $cart->setClient($faker->randomElement($user));
            $masterClass = $faker->randomElement($masterClasses);
            $pastrie = $faker->randomElement($pastries);
            if ($i % 2 == 0) {
                $cart->setCake($pastrie);
            } else {
                $cart->setMasterClass($masterClass);
            }
            $cart->setQuantity($faker->numberBetween(1, 5));
            $manager->persist($cart);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            // Load MasterClassFixtures before CartFixtures
            MasterClassFixtures::class,
            // Load PastrieFixtures before CartFixtures
            PastryFixture::class,
            // Load UserFixtures before CartFixtures
            UserFixtures::class
        ];
    }
}
