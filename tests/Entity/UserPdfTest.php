<?php

namespace App\Tests\Entity;

use App\Entity\Pdf;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserPdfTest extends TestCase
{
    public function testSetAndGetPdf()
    {
        $user = new User();
        $pdf = new Pdf();

        $pdf->setUser($user);
        $this->assertEquals($user, $pdf->getUser());

    }
}