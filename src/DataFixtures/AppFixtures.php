<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Subscription;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $subscriptionFree = new Subscription();
        $subscriptionFree->setTitle('Free');
        $subscriptionFree->setPrice(0);
        $subscriptionFree->setDescription('Free subscription');
        $subscriptionFree->setPdfLimit(10);
        $subscriptionFree->setMedia(true);

        $manager->persist($subscriptionFree);

        $subscriptionBasic = new Subscription();
        $subscriptionBasic->setTitle('Basic');
        $subscriptionBasic->setPrice(5);
        $subscriptionBasic->setDescription('Basic subscription');
        $subscriptionBasic->setPdfLimit(20);
        $subscriptionBasic->setMedia(true);

        $manager->persist($subscriptionBasic);

        $subscriptionPremium = new Subscription();
        $subscriptionPremium->setTitle('Premium');
        $subscriptionPremium->setPrice(10);
        $subscriptionPremium->setDescription('Premium subscription');
        $subscriptionPremium->setPdfLimit(50);
        $subscriptionPremium->setMedia(true);

        $manager->persist($subscriptionPremium);

        $manager->flush();
    }
}
