<?php

declare(strict_types=1);

namespace Progress\Application\Service;

interface FilesStorage
{
    public function upload(string $key): string;
    public function get(string $key): array;
}