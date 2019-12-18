<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Showtime;

use Cinema\Domain\Model\Showtime\Schedule;
use Tests\Cinema\FixtureTrait;

class ScheduleTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     * @throws \Exception
     */
    public function testTheDayIsScheduledOnMovieDay(): void
    {
        $schedule = new Schedule($this->createHolidayDateTime());

        $this->assertTrue($schedule->isScheduledOnMovieDay());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testTheDayIsNotScheduledOnMovieDay(): void
    {
        $schedule = new Schedule($this->createWeekdayDateTime());

        $this->assertFalse($schedule->isScheduledOnMovieDay());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testTheDayIsScheduledOnWeekday(): void
    {
        $schedule = new Schedule($this->createWeekdayDateTime());

        $this->assertTrue($schedule->isScheduledOnWeekday());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testTheDayIsNotScheduledOnWeekday(): void
    {
        $schedule = new Schedule($this->createHolidayDateTime());

        $this->assertFalse($schedule->isScheduledOnWeekday());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testTheDayIsScheduledOnHoliday(): void
    {
        $schedule = new Schedule($this->createHolidayDateTime());

        $this->assertTrue($schedule->isScheduledOnHoliday());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testTheDayIsNotScheduledOnHoliday(): void
    {
        $schedule = new Schedule($this->createWeekdayDateTime());

        $this->assertFalse($schedule->isScheduledOnHoliday());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testScheduleIsLateShow(): void
    {
        $schedule = new Schedule($this->createDateTimeUTC('2019-12-01 20:00:00'));

        $this->assertTrue($schedule->isLateShow());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testScheduleIsNotLateShow(): void
    {
        $schedule = new Schedule($this->createDateTimeUTC('2019-12-01 19:59:59'));

        $this->assertFalse($schedule->isLateShow());
    }
}
