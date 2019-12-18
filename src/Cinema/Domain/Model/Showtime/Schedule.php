<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Showtime;

use DateTime;

class Schedule
{
    /**
     * @var int
     */
    private const MOVIE_DAY_OF_EVERY_MONTH = 1;

    /**
     * @var int
     */
    private const LATE_HOUR = 20;

    /**
     * @var DateTime
     */
    private $startAt;

    /**
     * @param DateTime $startAt
     */
    public function __construct(DateTime $startAt)
    {
        $this->startAt = $startAt;
    }

    /**
     * @return bool
     */
    public function isScheduledOnMovieDay(): bool
    {
        return $this->startAt->format('j') == self::MOVIE_DAY_OF_EVERY_MONTH;
    }

    /**
     * @return bool
     */
    public function isScheduledOnWeekday(): bool
    {
        return in_array($this->startAt->format('N'), range(1, 5));
    }

    /**
     * @return bool
     */
    public function isScheduledOnHoliday(): bool
    {
        return in_array($this->startAt->format('N'), range(6, 7));
    }

    /**
     * @return bool
     */
    public function isLateShow(): bool
    {
        return self::LATE_HOUR <= $this->startAt->format('H');
    }
}
