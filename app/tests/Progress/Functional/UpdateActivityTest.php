<?php

declare(strict_types=1);

namespace Tests\Progress\Functional;

use Symfony\Component\HttpFoundation\Request;

final class UpdateActivityTest extends ProgressBaseTestCase
{
    public function testUpdateActivity(): void
    {
        $this->makeRequest();

        self::assertResponseIsSuccessful();
    }

    private function makeRequest(): void
    {
        $this->jsonRequest(
            Request::METHOD_PUT,
            '/api/progress/activity/1'
        );
    }
}