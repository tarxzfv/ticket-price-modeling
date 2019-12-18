<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Showtime;

class Showtime
{
    /**
     * @var string
     */
    private $movie;

    /**
     * @var Schedule
     */
    private $schedule;

    /**
     * @param string $movie
     * @param Schedule $schedule
     */
    public function __construct(string $movie, Schedule $schedule)
    {
        $this->movie = $movie;
        $this->schedule = $schedule;
    }

    /**
     * @return bool
     */
    public function isScheduledOnMovieDay(): bool
    {
        return $this->schedule->isScheduledOnMovieDay();
    }

    /**
     * @return bool
     */
    public function isScheduledOnWeekday(): bool
    {
        return $this->schedule->isScheduledOnWeekday();
    }

    /**
     * @return bool
     */
    public function isScheduledOnHoliday(): bool
    {
        return $this->schedule->isScheduledOnHoliday();
    }

    /**
     * @return bool
     */
    public function isLateShow(): bool
    {
        return $this->schedule->isLateShow();
    }
}
