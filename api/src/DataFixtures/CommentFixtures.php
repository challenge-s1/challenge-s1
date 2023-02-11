<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use App\DataFixtures\UserFixtures;
use App\Entity\MasterClass;
use App\Entity\ReasonReporting;
use App\Entity\User;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $users = $manager->getRepository(User::class)->findAll();
        $patissiersUser = array_filter($users, function ($user) {
            return in_array('ROLE_PATISSIER' || 'ROLE_USER', $user->getRoles());
        });
        $masterClasses = $manager->getRepository(MasterClass::class)->findAll();
        for ($i = 1; $i <= 10; $i++) {
            $comment = new Comment();
            $comment->setContent($faker->paragraph(3));
            $comment->setUserid($faker->randomElement($patissiersUser));
            $comment->setMasterid($faker->randomElement($masterClasses));
            $manager->persist($comment);
        }


        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            MasterClassFixtures::class
        ];
    }
}
