<?php

declare(strict_types=1);

namespace Tests\Progress\Unit;

use DateTime;
use PHPUnit\Framework\TestCase;
use Progress\Application\Command\UpdateStatusActivity;
use Progress\Application\Handler\UpdateStatusActivityHandler;
use Progress\Domain\Activity;
use Progress\Domain\Day;
use Tests\Progress\Unit\Fake\FakeDayRepository;

/**
 * @covers \Progress\Application\Handler\UpdateStatusActivityHandler
 */
final class UpdateStatusActivityTest extends TestCase
{
    private UpdateStatusActivityHandler $updateStatusActivityHandler;
    private Day $day;

    protected function setUp(): void
    {
        parent::setUp();

        $this->updateStatusActivityHandler = new UpdateStatusActivityHandler(
          new FakeDayRepository(
              $this->day = new Day(
                  1,
                  new DateTime(),
                  new Activity(
                      1,
                      'activity_1'
                  ),
                  false,
              )
          )
        );
    }

    public function testUpdateStatusActivity(): void
    {
        $this->updateStatusActivityHandler->__invoke(new UpdateStatusActivity(1));
        $this->assertTrue($this->day->isComplete());
    }
}