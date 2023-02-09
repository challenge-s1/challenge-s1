<?php

namespace App\DataFixtures;

use App\Entity\ReasonReporting;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ReasonFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $reason1 = new ReasonReporting();
        $reason1->setName('Undesirable content');

        $reason2 = new ReasonReporting();
        $reason2->setName('Fake news');

        $reason3 = new ReasonReporting();
        $reason3->setName('Hate speech or symbols');

        $reason4 = new ReasonReporting();
        $reason4->setName('Sexual content');

        $reason5 = new ReasonReporting();
        $reason5->setName('Harassment or bullying');

        $reason6 = new ReasonReporting();
        $reason6->setName('Intellectual property violation');

        $reason7 = new ReasonReporting();
        $reason7->setName('Impersonation');

        $manager->persist($reason1);
        $manager->persist($reason2);
        $manager->persist($reason3);
        $manager->persist($reason4);
        $manager->persist($reason5);
        $manager->persist($reason6);
        $manager->persist($reason7);


        $manager->flush();
    }
}
