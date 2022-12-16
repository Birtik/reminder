<?php

declare(strict_types=1);

namespace SharedKernel\Application\Aws\Queue\Process;

use SharedKernel\Application\Aws\Queue\Process\Exception\DelayMessageException;

final class Process
{
    private Transport $transport;
    private Dispatcher $dispatcher;
    private ConsumerResolver $consumerResolver;

    public function __construct(
        Transport $transport,
        Dispatcher $dispatcher,
        ConsumerResolver $consumerResolver
    ) {
        $this->transport = $transport;
        $this->dispatcher = $dispatcher;
        $this->consumerResolver = $consumerResolver;
    }

    public function process(string $queue): void
    {
        while (true) {
            foreach ($this->transport->getMessages($queue) as $message) {
                try {
                    $this->consumerResolver->resolve($message->getAction())->process($message);
                } catch (DelayMessageException $e) {
                    $destinationQueue = $queue;

                    $this->transport->sendMessage($message->duplicate(), $destinationQueue, $e->getDelay());
                } finally {
                    $this->transport->remove($queue, $message);
                }
            }
        }
    }
}