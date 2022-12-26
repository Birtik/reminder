<?php

namespace Tests\Progress\Functional;

use Symfony\Component\HttpFoundation\Request;

final class GetS3FileTest extends ProgressBaseTestCase
{
    public function testUpdateActivity(): void
    {
        $this->makeRequest();

        self::assertResponseIsSuccessful();
    }

    private function makeRequest(): void
    {
        $this->jsonRequest(
            Request::METHOD_GET,
            'api/files/test'
        );
    }
}