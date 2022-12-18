<?php

declare(strict_types=1);

namespace SharedKernel\Infrastructure\Aws\S3\Factory;

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;

final class ClientFactory
{
    public static function build(Credentials $credentials, string $region): S3Client
    {
        $config = [
            'credentials' => $credentials,
            'region' => $region,
            'version' => 'latest',
        ];

        return new S3Client($config);
    }
}