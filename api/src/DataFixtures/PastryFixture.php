<?php

namespace App\DataFixtures;

use App\Entity\Pastrie;
use App\Entity\User;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\DataFixtures\UserFixtures;


class PastryFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $users = $manager->getRepository(User::class)->findAll();
        $patissiers = array_filter($users, function ($user) {
            return in_array('ROLE_PATISSIER', $user->getRoles());
        });
        $categoys = $manager->getRepository(Category::class)->findAll();

        for ($i = 1; $i <= 10; $i++) {
            $pastrie = new Pastrie();
            $pastrie->setName($faker->sentence(3));
            $pastrie->setDescription($faker->paragraph(3));
            $pastrie->setPrice($faker->randomFloat(2, 10, 100));
            $pastrie->setPicture('63e1a24a5362c_Watercolor Cup Cake Bakery Logo (1).png');
            $pastrie->setOwner($faker->randomElement($patissiers));
            $categoy = $faker->randomElement($categoys);
            $pastrie->setCategory($categoy);
            $pastrie->setStatus(false);
            $manager->persist($pastrie);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CategoryFixtures::class
        ];
    }
}
