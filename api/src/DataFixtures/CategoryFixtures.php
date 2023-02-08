<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $category1 = new Category();
        $category1->setName('Cake');

        $category2 = new Category();
        $category2->setName('Cupcake');

        $category3 = new Category();
        $category3->setName('Macaron');

        $category4 = new Category();
        $category4->setName('Cookie');

        $category5 = new Category();
        $category5->setName('Brownie');

        $category6 = new Category();
        $category6->setName('Muffin');

        $category7 = new Category();
        $category7->setName('Biscuit');

        $category8 = new Category();
        $category8->setName('Bread');

        $category9 = new Category();
        $category9->setName('Pastry');

        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);
        $manager->persist($category4);
        $manager->persist($category5);
        $manager->persist($category6);
        $manager->persist($category7);
        $manager->persist($category8);
        $manager->persist($category9);

        $manager->flush();
    }
}
