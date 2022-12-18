<?php

declare(strict_types=1);

namespace Progress\Domain;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity, ORM\Table(name: 'days')]
class Day
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

    public function __construct()
    {
    }

    public function markAsComplete(): void
    {
        $this->complete = true;
    }
}