<?php

namespace SharedKernel\Infrastructure\Aws\Sqs;

use SharedKernel\Application\Aws\Queue\Message;
use SharedKernel\Application\Aws\Queue\Message\Exception\NullableDataException;
use SharedKernel\Application\Aws\Queue\Process\Transport;
use Aws\Sqs\SqsClient;
use Psr\Log\LoggerInterface;

class Sqs implements Transport
{
    private SqsClient $client;
    private LoggerInterface $monologger;

    public function __construct(SqsClient $client, LoggerInterface $monologger)
    {
        $this->client = $client;
        $this->monologger = $monologger;
    }

    /**
     * @param string $queue The name of queue
     *
     * @return Message[]
     */
    public function getMessages(string $queue): array
    {
        $response = $this->client->receiveMessage([
            'QueueUrl' => $this->getQueueUrl($queue),
            'MaxNumberOfMessages' => 10,
        ]);
        $messages = [];

        if ($response->get('Messages')) {
            foreach ($response->get('Messages') as $message) {
                try {
                    $messages[] = Message::fromSqsMessage($message);
                } catch (NullableDataException $e) {
                    $this->monologger->warning('Nullable body in message', $message);
                }
            }
        }

        return $messages;
    }

    public function remove(string $queue, SqsMessage $message): void
    {
        $this->client->deleteMessage([
            'QueueUrl' => $this->getQueueUrl($queue),
            'ReceiptHandle' => $message->getHandle(),
        ]);
    }

    public function sendMessage(SqsMessage $message, string $queue, int $delay = 0): void
    {
        $arguments = [
            'QueueUrl' => $this->getQueueUrl($queue),
            'MessageBody' => json_encode($message->getBody()),
        ];

        if (0 !== $delay) {
            $arguments['DelaySeconds'] = (new DeliveryDelay($delay))->toInt();
        }

        $this->client->sendMessage($arguments);
    }

    private function getQueueUrl(string $queue): string
    {
        $endpoint = (string)$this->client->getEndpoint();

        if (!$endpoint) {
            $endpoint = sprintf('https://sqs.%s.amazonaws.com/933772444598', $this->client->getRegion());
        }

        return "$endpoint/$queue";
    }
}