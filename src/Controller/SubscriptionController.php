<?php

namespace App\Controller;

use App\Entity\Subscription;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class SubscriptionController extends AbstractController
{
    #[Route('/subscription', name: 'app_subscription')]
    public function index(PersistenceManagerRegistry $doctrine): Response
    {

        $em = $doctrine->getManager();

        $subscription = $em->getRepository(Subscription::class)->findAll();


        $user = $this->getUser();
        $subscriptionUser = $user->getSubscription();


        return $this->render('subscription/index.html.twig', [
            'controller_name' => 'SubscriptionController',
            'subscriptions' => $subscription,
            'subscriptionUser' => $subscriptionUser
        ]);
    }
}
