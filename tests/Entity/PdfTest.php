<?php

namespace App\Tests\Entity;

use App\Entity\Pdf;
use PHPUnit\Framework\TestCase;

class PdfTest extends TestCase
{
    public function testGetterAndSetter()
    {
        $pdf = new Pdf();

        // Données du test
        $title = 'Test';
        $createdAt = new \DateTimeImmutable();

        // Test des setters

        $pdf->setTitle($title);
        $pdf->setCreatedAt($createdAt);

        // Test des getters

        $this->assertEquals($title, $pdf->getTitle());
        $this->assertEquals($createdAt, $pdf->getCreatedAt());
    }
}