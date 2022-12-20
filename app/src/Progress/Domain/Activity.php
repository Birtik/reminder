<?php

declare(strict_types=1);

namespace Progress\Domain;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity, ORM\Table(name: 'activity')]
class Activity implements JsonSerializable
{
    #[ORM\Id, ORM\Column(type: Types::INTEGER), ORM\GeneratedValue(strategy: 'IDENTITY')]
    private int $id;

    #[ORM\Column(name: 'name', type: Types::STRING, length: 50)]
    private string $name;

    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->name,
        ];
    }
}