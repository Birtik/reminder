<?php

declare(strict_types=1);

namespace Tests\Progress\Utils;

use JsonException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

trait KernelBrowserHttpClientTrait
{
    private KernelBrowser $httpClient;

    private function setUpHttpClient(): void
    {
        $this->httpClient = self::createClient();
    }

    protected function jsonRequest(
        string $method,
        string $uri,
        string $content = null,
        array $server = [],
        array $parameters = [],
        array $files = [],
    ): void {
        $server = array_merge($server, [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'application/json',
        ]);

        $this->httpClient->request($method, $uri, $parameters, $files, $server, $content);
    }
}