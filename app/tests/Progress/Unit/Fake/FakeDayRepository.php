<?php

declare(strict_types=1);

namespace Tests\Progress\Unit\Fake;

use Progress\Domain\Day;
use Progress\Domain\Repository\DayRepository;

final class FakeDayRepository implements DayRepository
{
    private array $days = [];

    public function __construct(Day $day)
    {
        $this->days[$day->getId()] = $day;
    }

    public function getAllDays(): array
    {
        return [];
    }

    public function findOneByActivity(int $id): Day
    {
        return $this->days[1];
    }

    public function update(Day $day): void
    {
        $day->markAsComplete();
    }
}