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
        return $this->render('doc/index.html.twig');
    }

    /**
     * @throws \Exception
     * @throws TransportExceptionInterface
     */
    #[Route('/pdf/convert', name: 'app_doc_convert', methods: ['POST'])]
    public function convert(Request $request, PersistenceManagerRegistry $doctrine): Response
    {


        $url = $request->request->get('url');
        $pdfFilePath = $this->symfonyDocs->generatePdfFromUrl($url);

        // Créer une nouvelle instance de Pdf et lui attribuer les valeurs nécessaires
        $pdf = new Pdf();
        $pdf->setTitle('PDF title');
        $pdf->setCreatedAt(new \DateTimeImmutable());
        $pdf->setUser($this->getUser()); // Associez le PDF à l'utilisateur actuellement connecté

        // Enregistrez le PDF dans la base de données

       $doctrine->getManager();
        $entityManager = $doctrine->getManager();
        $entityManager->persist($pdf);
        $entityManager->flush();

        // Retournez le PDF généré
        return $this->file($pdfFilePath);
    }
}
