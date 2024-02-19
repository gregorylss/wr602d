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

class DocController extends AbstractController
{
    private SymfonyDocs $symfonyDocs;

    public function __construct(SymfonyDocs $symfonyDocs)
    {
        $this->symfonyDocs = $symfonyDocs;
    }

    #[Route('/pdf', name: 'app_doc')]
    public function index(): Response
    {


        $user = $this->getUser();



        return $this->render('doc/index.html.twig', [

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
