<?php

namespace App\DataFixtures;

use App\Entity\MasterClass;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\DataFixtures\UserFixtures;


class MasterClassFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $users = $manager->getRepository(User::class)->findAll();
        $patissiers = array_filter($users, function ($user) {
            return in_array('ROLE_PATISSIER', $user->getRoles());
        });
        for ($i = 1; $i <= 10; $i++) {
            $masterClass = new MasterClass();
            $masterClass->setTitle($faker->sentence(3));
            $masterClass->setDescription($faker->paragraph(3));
            $masterClass->setPrice($faker->randomFloat(2, 10, 100));
            $masterClass->setMaxNumber($faker->numberBetween(5, 20));
            $masterClass->setIsCanceled(false);
            $masterClass->setOwner($faker->randomElement($patissiers));
            $manager->persist($masterClass);
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
