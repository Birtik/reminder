<?php

declare(strict_types=1);

namespace SharedKernel\Application\Aws\Queue\Process;

class Dispatcher
{
    private array $listeners = [];

    public function dispatch(string $event, array $params = []): void
    {
        foreach ($this->getListeners($event) as $listener) {
            $listener(...$params);
        }
    }

    private function getListeners(string $eventName): array
    {
        return $this->listeners[$eventName] ?? [];
    }
}