<?php

declare(strict_types=1);

namespace Progress\Domain\Repository;

use Progress\Domain\Day;

interface DayRepository
{
    public function getAllDays(): array;
    public function findOneByActivity(int $id): Day;
    public function update(Day $day): void;
}