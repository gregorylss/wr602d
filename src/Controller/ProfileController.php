<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PdfRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(PdfRepository $pdfRepository, UserInterface $user): Response
    {
        $userId = $user->getId();
        $startOfDay = date('Y-m-d');
        $endOfDay = date('Y-m-d 23:59:59');
        $numberOfPDFs = $pdfRepository->countPdfGeneratedByUserOnDate($userId, $startOfDay, $endOfDay);

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'number_of_pdfs' => $numberOfPDFs, // Passez le nombre de PDFs à votre vue pour l'afficher
            'end_of_day' => $endOfDay, // Passez la date de fin de journée à votre vue pour l'afficher
        ]);
    }
}
