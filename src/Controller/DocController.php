<?php

namespace App\Controller;

use App\Entity\Pdf;
use App\Service\SymfonyDocs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use App\Repository\PdfRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class DocController extends AbstractController
{
    private SymfonyDocs $symfonyDocs;

    public function __construct(SymfonyDocs $symfonyDocs, PdfRepository $PdfRepository)
    {
        $this->symfonyDocs = $symfonyDocs;
        $this->PdfRepository = $PdfRepository;
    }

    #[Route('/pdf', name: 'app_doc')]
    public function index(PdfRepository $pdfRepository): Response
    {
        $user = $this->getUser();


        $quota = $user->getSubscription()->getPdfLimit();

        $countPdfToday = $pdfRepository->countPdfGeneratedByUserOnDate(
            $user->getId(),
            new \DateTime('today midnight'),
            new \DateTime('tomorrow midnight')
        );

        $quota_exceeded = $countPdfToday >= $quota;


        $pdfs = $user->getPdf();
        $pdfsCount = count($pdfs);
        $pdfsRemaining = $quota - $pdfsCount;


        return $this->render('doc/index.html.twig', [
            'quota_exceeded' => $quota_exceeded,
            'controller_name' => 'DocController',
            'pdfs_remaining' => $pdfsRemaining,
        ]);
    }


    /**
     * @throws \Exception
     * @throws TransportExceptionInterface
     */
    #[Route('/pdf/convert', name: 'app_doc_convert', methods: ['POST'])]
    public function convert(Request $request, PersistenceManagerRegistry $doctrine): Response
    {
        $pdf = new Pdf();
        $pdfName = $request->request->get('title');
        $pdf->setTitle($pdfName);
        $pdf->setCreatedAt(new \DateTimeImmutable());
        $pdf->setFilepath('/pdfs/' . $pdfName . '.pdf');
        $pdf->setUser($this->getUser());


        $doctrine->getManager();
        $entityManager = $doctrine->getManager();
        $entityManager->persist($pdf);
        $entityManager->flush();

        $url = $request->request->get('url');
        $pdfFilePath = $this->symfonyDocs->generatePdfFromUrl($url, $pdfName);

        return $this->file($pdfFilePath);
    }
}
