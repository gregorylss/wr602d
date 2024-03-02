<?php

namespace App\Controller;

use App\Entity\Subscription;
use App\Form\ChangeSubscriptionType;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

class SubscriptionController extends AbstractController
{
    #[Route('/subscription', name: 'app_subscription')]
    public function index(PersistenceManagerRegistry $doctrine, Request $request, UserInterface $user, EntityManagerInterface $entityManager): Response
    {
        $em = $doctrine->getManager();
        $subscriptions = $em->getRepository(Subscription::class)->findAll();
        $subscriptionUser = $user->getSubscription();

        $form = $this->createForm(ChangeSubscriptionType::class, $user);
        $form->handleRequest($request);


        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('subscription/index.html.twig', [
            'controller_name' => 'SubscriptionController',
            'subscriptions' => $subscriptions,
            'subscriptionUser' => $subscriptionUser,
            'form' => $form->createView()
        ]);
    }
}
