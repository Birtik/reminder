<?php

declare(strict_types=1);

namespace Progress\Application\Query;

use Progress\Application\View\FinishedDaysViewCollection;

interface GetAllDaysQuery
{
    public function __invoke(): FinishedDaysViewCollection;
}