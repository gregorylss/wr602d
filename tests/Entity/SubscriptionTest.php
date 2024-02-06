<?php

namespace App\Tests\Entity;

use App\Entity\Subscription;
use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{
    public function testGetterAndSetter()
    {
        $subscription = new Subscription();

        // Données du test
        $title = 'Ultra';
        $description = 'Abonnement de test';
        $price = 10.00;
        $media = 'image.jpg';
        $pdfLimit = 10;

        // Test des setters

        $subscription->setTitle($title);
        $subscription->setDescription($description);
        $subscription->setPrice($price);
        $subscription->setMedia($media);
        $subscription->setPdfLimit($pdfLimit);

        // Test des getters

        $this->assertEquals($title, $subscription->getTitle());
        $this->assertEquals($description, $subscription->getDescription());
        $this->assertEquals($price, $subscription->getPrice());
        $this->assertEquals($media, $subscription->getMedia());
        $this->assertEquals($pdfLimit, $subscription->getPdfLimit());
    }
}
