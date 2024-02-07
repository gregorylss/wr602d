<?php


namespace App\Tests\Service;

use App\Service\SymfonyDocs;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class SymfonyDocsTest extends TestCase
{
    public function testGeneratePdfFromUrl(): void
    {
        $httpClient = new MockHttpClient([
            new MockResponse('PDF content'),
        ]);

        $symfonyDocsService = new SymfonyDocs($httpClient);

        $pdfFilePath = $symfonyDocsService->generatePdfFromUrl('https://example.com');

        $this->assertStringEndsWith('.pdf', $pdfFilePath);
        $this->assertFileExists($pdfFilePath);

        unlink($pdfFilePath);
    }
}
