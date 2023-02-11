<?php

namespace App\DataFixtures;

use App\Entity\VoucherDiscount;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\DataFixtures\UserFixtures;


class VoucherFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $allUsers = $manager->getRepository(User::class)->findAll();
        $users = array_filter($allUsers, function ($user) {
            return in_array('ROLE_USER', $user->getRoles());
        });
        for ($i = 1; $i <= 10; $i++) {
            $voucher = new VoucherDiscount();
            $voucher->setPrice($faker->randomFloat(2, 10, 20));
            $voucher->setOwner($faker->randomElement($users));
            $manager->persist($voucher);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
