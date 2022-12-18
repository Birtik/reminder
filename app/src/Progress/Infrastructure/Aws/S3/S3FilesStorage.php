<?php

declare(strict_types=1);

namespace Progress\Infrastructure\Aws\S3;

use Aws\S3\S3Client;
use Progress\Application\Service\FilesStorage;

final class S3FilesStorage implements FilesStorage
{
    public function __construct(private S3Client $client, private string $bucketName)
    {
    }

    public function get(string $key): array
    {
        $result = $this->client->getObject(
            [
                'Bucket' => $this->bucketName,
                'Key' => $key,
            ]
        );

        return $result->toArray();
    }
}