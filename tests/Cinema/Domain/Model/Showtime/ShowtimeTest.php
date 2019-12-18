<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Showtime;

use DateTime;
use Tests\Cinema\FixtureTrait;

class ShowtimeTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     * @throws \Exception
     */
    public function testTheDayIsScheduledOnMovieDay(): void
    {
        $showtime = $this->createShowtime(null, new DateTime('2019-12-01'));

        $this->assertTrue($showtime->isScheduledOnMovieDay());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testTheDayIsScheduledOnWeekday(): void
    {
        $showtime = $this->createShowtime(null, new DateTime('2019-12-02'));

        $this->assertTrue($showtime->isScheduledOnWeekday());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testTheDayIsScheduledOnHoliday(): void
    {
        $showtime = $this->createShowtime(null, new DateTime('2019-12-01'));

        $this->assertTrue($showtime->isScheduledOnHoliday());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testScheduleIsLateShow(): void
    {
        $showtime = $this->createShowtime(null, new DateTime('2019-12-01 20:00:00'));

        $this->assertTrue($showtime->isLateShow());
    }
}
