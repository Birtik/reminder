<?php

declare(strict_types=1);

namespace SharedKernel\Application\Aws\Queue\Process;

use SharedKernel\Application\Aws\Queue\Process\Exception\ConsumerExistsException;
use SharedKernel\Application\Aws\Queue\Process\Exception\ConsumerNotFoundException;
use Webmozart\Assert\Assert;

final class ConsumerResolver
{
    private array $consumers;

    public function __construct(iterable $consumers)
    {
        $this->consumers = $this->map($consumers);
    }

    public function has(string $action): bool
    {
        return array_key_exists($action, $this->consumers);
    }

    /**
     * @throws ConsumerNotFoundException
     */
    public function resolve(string $action): Consumer
    {
        if (!$this->has($action)) {
            throw ConsumerNotFoundException::fromAction($action);
        }

        return $this->consumers[$action];
    }

    public function isEmpty(): bool
    {
        return 0 === count($this->consumers);
    }

    /**
     * @throws ConsumerExistsException
     */
    private function map(iterable $collection): array
    {
        Assert::allIsInstanceOf($collection, Consumer::class);
        $result = [];

        /** @var Consumer $consumer */
        foreach ($collection as $consumer) {
            if (array_key_exists($consumer->getAction(), $result)) {
                throw ConsumerExistsException::fromAction($consumer->getAction());
            }

            $result[$consumer->getAction()] = $consumer;
        }

        return $result;
    }
}