<?php

declare(strict_types=1);

namespace Progress\Domain;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use JetBrains\PhpStorm\Internal\TentativeType;
use JsonSerializable;

#[ORM\Entity, ORM\Table(name: 'days')]
class Day implements JsonSerializable
{
    #[ORM\Id, ORM\Column(type: Types::INTEGER), ORM\GeneratedValue(strategy: 'IDENTITY')]
    private int $id;

    #[ORM\Column(name: 'date', type: Types::DATETIME_MUTABLE)]
    private DateTime $date;

    #[ManyToOne(targetEntity: Activity::class)]
    #[JoinColumn(name: 'activity_id', referencedColumnName: 'id')]
    private Activity $activity;

    #[ORM\Column(name: 'complete', type: Types::BOOLEAN)]
    private bool $complete;

    public function markAsComplete(): void
    {
        $this->complete = true;
    }

    public function jsonSerialize(): array
    {
        return [
            'date' => $this->date,
            'activity' => $this->activity,
            'complete' => $this->complete,
        ];
    }
}