<?php

declare(strict_types=1);

namespace Tests\Progress\Unit\Fake;

use Progress\Application\Service\FilesStorage;

final class FakeFilesStorage implements FilesStorage
{
    public function get(string $key): array
    {
        return [
            'Body' => 'test',
        ];
    }
}