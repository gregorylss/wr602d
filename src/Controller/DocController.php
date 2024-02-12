<?php

namespace App\Controller;

use App\Service\SymfonyDocs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class DocController extends AbstractController
{
    private SymfonyDocs $symfonyDocs;

    public function __construct(SymfonyDocs $symfonyDocs)
    {
        $this->symfonyDocs = $symfonyDocs;
    }

    #[Route('/doc', name: 'app_doc')]
    public function index(): Response
    {
        return $this->render('doc/index.html.twig');
    }

    /**
     * @throws \Exception
     * @throws TransportExceptionInterface
     */
    #[Route('/doc/convert', name: 'app_doc_convert', methods: ['POST'])]
    public function convert(Request $request): Response
    {
        $url = $request->request->get('url');
        $pdfFilePath = $this->symfonyDocs->generatePdfFromUrl($url);

        return $this->file($pdfFilePath);
    }

}