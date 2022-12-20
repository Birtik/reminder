<?php

declare(strict_types=1);

namespace SharedKernel\Application\Aws\Queue\Message;

final class Metadata implements \JsonSerializable
{
    /**
     * @var int
     */
    private int $retryCount;

    /**
     * @param array $metadata
     *
     * @return Metadata
     */
    public static function fromArray(array $metadata): self
    {
        return new self($metadata['retryCount'] ?? 0);
    }

    /**
     * @param int $retryCount
     */
    public function __construct(int $retryCount = 0)
    {
        $this->retryCount = $retryCount;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'retryCount' => $this->retryCount,
        ];
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}