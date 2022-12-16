<?php

declare(strict_types=1);

namespace SharedKernel\Infrastructure\Aws\Sqs;

class SqsMessage
{
    private array $body;
    private string $handle;

    public function __construct(array $body, string $handle = null)
    {
        $this->body = $body;
        $this->handle = $handle ?? '';
    }

    /**
     * @return string
     */
    public function getHandle(): string
    {
        return $this->handle;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }
}