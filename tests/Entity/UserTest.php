<?php
// tests/Entity/UserTest.php
namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetterAndSetter()
    {
        $user = new User();

      // Données du test
        $firstname = 'John';
        $lastname = 'Doe';
        $role = 'ROLE_USER';
        $email = 'test@test.com';
        $password = 'password';
        $createdAt = new \DateTimeImmutable();
        $updateAt = new \DateTime();
        $subscriptionEndAt = new \DateTime();


        // Test des setters

        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setRole($role);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setCreatedAt($createdAt);
        $user->setUpdatedAt($updateAt);
        $user->setSubscriptionEndAt($subscriptionEndAt);

        // Test des getters

        $this->assertEquals($firstname, $user->getFirstname());
        $this->assertEquals($lastname, $user->getLastname());
        $this->assertEquals($role, $user->getRole());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($password, $user->getPassword());
        $this->assertEquals($createdAt, $user->getCreatedAt());
        $this->assertEquals($updateAt, $user->getUpdatedAt());
        $this->assertEquals($subscriptionEndAt, $user->getSubscriptionEndAt());

    }
}