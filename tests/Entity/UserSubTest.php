<?php
use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Entity\Subscription;

class UserSubTest extends TestCase {

    public function testSetAndGetSubscription() {
        $user = new User();
        $firstname = 'John';
        $lastname = 'Doe';
        $role = 'ROLE_USER';
        $email = 'test@test.com';
        $password = 'password';
        $createdAt = new \DateTimeImmutable();
        $updateAt = new \DateTime();
        $subscriptionEndAt = new \DateTime();

        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setRole($role);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setCreatedAt($createdAt);
        $user->setUpdatedAt($updateAt);
        $user->setSubscriptionEndAt($subscriptionEndAt);

        $subscription = new Subscription();
        $title = 'Test';
        $price = 10;
        $description = 'Test';
        $media = 'test.jpg';
        $pdfLimit = 10;

        $subscription->setTitle($title);
        $subscription->setPrice($price);
        $subscription->setDescription($description);
        $subscription->setMedia($media);
        $subscription->setPdfLimit($pdfLimit);

        $user->setSubscription($subscription);
        $this->assertEquals($subscription, $user->getSubscription());

    }
}
