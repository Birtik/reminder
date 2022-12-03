<?php

declare(strict_types=1);

namespace SharedKernel\Domain\Aws\DynamoDb;

use SharedKernel\Application\Aws\DynamoDb\KeyValueDatabaseClient;
use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Marshaler;
use SharedKernel\Domain\Aws\DynamoDb\Exception\DatabaseException;
use JsonException;

class DynamoDb implements KeyValueDatabaseClient
{
    public function __construct(
        private DynamoDbClient $client,
        private Marshaler $marshaler,
        private string $tableName
    ) {
    }

    /**
     * @throws DatabaseException
     * @throws JsonException
     */
    public function get(array $key): array
    {
        $item = $this->client->getItem([
            'TableName' => $this->tableName,
            'Key' => $this->marshaler->marshalItem($key),
        ]);

        if (!isset($item['Item'])) {
            throw new DatabaseException(
                sprintf(
                    'Item for key (%s) not found in (%s) table',
                    json_encode($key, JSON_THROW_ON_ERROR),
                    $this->tableName
                )
            );
        }

        return (array) $this->marshaler->unmarshalItem($item['Item'], false);
    }

    public function update(array $key, array $values): void
    {
        $expressionAttributeNames = [];
        $expressionAttributeValues = [];
        $updateExpression = '';

        foreach ($values as $fieldName => $value) {
            $updateExpression = sprintf('%s#%s = :%s, ', $updateExpression, $fieldName, $fieldName);
            $expressionAttributeValues[sprintf(':%s', $fieldName)] = $this->marshaler->marshalValue($value);
            $expressionAttributeNames[sprintf('#%s', $fieldName)] = $fieldName;
        }

        $this->client->updateItem([
            'TableName' => $this->tableName,
            'Key' => $this->marshaler->marshalItem($key),
            'UpdateExpression' => sprintf('set %s', rtrim($updateExpression, ', ')),
            'ExpressionAttributeValues' => $expressionAttributeValues,
            'ExpressionAttributeNames' => $expressionAttributeNames,
        ]);
    }

    public function delete(array $key): void
    {
        $this->client->deleteItem([
            'TableName' => $this->tableName,
            'Key' => $this->marshaler->marshalItem($key),
        ]);
    }
}