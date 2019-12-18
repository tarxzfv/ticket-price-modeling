<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Customer;

use Cinema\Domain\Model\Exception\IncorrectValueException;
use DateInterval;
use DateTime;

class Age
{
    /**
     * @var int
     */
    public const SENIOR_THRESHOLD = 70;

    /**
     * @var int
     */
    public const KIDS_AGE_FROM = 3;

    /**
     * @var int
     */
    public const KIDS_AGE_TO = 12;

    /**
     * @var int
     */
    private $value;

    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        if (!$this->isValid($value)) {
            throw new IncorrectValueException();
        }

        $this->value = $value;
    }

    /**
     * @param DateTime $birthday
     * @return Age
     * @throws \Exception|IncorrectValueException
     */
    public static function createFromBirthday(DateTime $birthday): self
    {
        $interval = $birthday->diff(new DateTime());

        if (!($interval instanceof DateInterval) || $interval->invert === 1) {
            throw new IncorrectValueException();
        }

        return new self($interval->y);
    }

    /**
     * @return bool
     */
    public function isSenior(): bool
    {
        return $this->value >= self::SENIOR_THRESHOLD;
    }

    /**
     * @return bool
     */
    public function isKid(): bool
    {
        return self::KIDS_AGE_FROM <= $this->value &&
                $this->value <= self::KIDS_AGE_TO;
    }

    /**
     * @param int $value
     * @return bool
     */
    private function isValid(int $value): bool
    {
        return 0 <= $value;
    }
}
