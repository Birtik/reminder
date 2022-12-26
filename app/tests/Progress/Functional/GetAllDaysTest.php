<?php

declare(strict_types=1);

namespace Tests\Progress\Functional;

use Symfony\Component\HttpFoundation\Request;

final class GetAllDaysTest extends ProgressBaseTestCase
{
    public function testGetAllDays(): void
    {
        $this->makeRequest();

        self::assertResponseIsSuccessful();
    }

    private function makeRequest(): void
    {
        $this->jsonRequest(
            Request::METHOD_GET,
            '/api/progress'
        );
    }
}