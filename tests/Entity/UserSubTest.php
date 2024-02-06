<?php
use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Entity\Subscription;

class UserSubTest extends TestCase {

    public function testSetAndGetSubscription() {
        $user = new User();
        $subscription = new Subscription();

        $user->setSubscription($subscription);
        $this->assertEquals($subscription, $user->getSubscription());

    }
}
