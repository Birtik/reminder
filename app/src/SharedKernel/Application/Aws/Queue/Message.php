<?php

namespace SharedKernel\Application\Aws\Queue;

use SharedKernel\Application\Aws\Queue\Message\Exception\NullableDataException;
use SharedKernel\Application\Aws\Queue\Message\Exception\PropertyNotFoundException;
use SharedKernel\Application\Aws\Queue\Message\Exception\PropertyValueEmptyException;
use SharedKernel\Application\Aws\Queue\Message\Metadata;
use SharedKernel\Infrastructure\Aws\Sqs\SqsMessage;

class Message extends SqsMessage
{
    private string $action;
    private array $data;
    private ?Metadata $metadata;

    public static function fromSqsMessage(array $message): self
    {
        $body = \json_decode($message['Body'], true) ?? ['action' => 'empty', 'data' => []];
        $metadata = Metadata::fromArray($body['metadata'] ?? []);

        if (!isset($body['data'])) {
            throw new NullableDataException();
        }

        return self::fromArray($body, $message['ReceiptHandle'], $metadata);
    }

    public static function fromArray(array $body, string $handle, ?Metadata $metadata = null): self
    {
        return new self($body['action'], $body['data'], $metadata, $handle);
    }

    public function __construct(string $action, array $data = [], ?Metadata $metadata = null, string $handle = '')
    {
        if (null === $metadata) {
            $metadata = new Metadata();
        }

        parent::__construct(
            [
                'action' => $action,
                'data' => $data,
                'metadata' => $metadata->toArray(),
            ],
            $handle
        );
        $this->action = $action;
        $this->data = $data;
        $this->metadata = $metadata;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getProperties(): array
    {
        return $this->data;
    }

    public function getMetadata(): Metadata
    {
        return $this->metadata;
    }

    public function duplicate(): self
    {
        return new self($this->getAction(), $this->getProperties(), $this->getMetadata());
    }
}