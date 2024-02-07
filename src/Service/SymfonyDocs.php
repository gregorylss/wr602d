<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SymfonyDocs
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function generatePdfFromUrl(string $url): string
    {

        $url = 'https://symfony.com/doc/current/index.html';

        $response = $this->client->request('POST', 'http://localhost:3000/forms/chromium/convert/url',
        [
            'headers' => [
                'Content-Type' => 'multipart/form-data',
            ],
            'body' => [
                'url' => $url,
            ],
        ]
        );

        $pdfFilePath = tempnam(sys_get_temp_dir(), 'symfony-docs-') . '.pdf';
        file_put_contents($pdfFilePath, $response->getContent());

        return $pdfFilePath;
    }

}