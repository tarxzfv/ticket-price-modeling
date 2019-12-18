<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Customer;

use Cinema\Domain\Model\Exception\IncorrectValueException;

class Membership
{
    /**
     * @var string
     */
    public const CINEMA_CITIZEN = 'cinema-citizen';

    /**
     * @var string
     */
    public const CINEMA_CITIZEN_SENIOR = 'cinema-citizen-senior';

    /**
     * @var string[]
     */
    private const VALUES = [
        self::CINEMA_CITIZEN,
        self::CINEMA_CITIZEN_SENIOR,
    ];

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (!$this->isValid($value)) {
            throw new IncorrectValueException();
        }

        $this->value = $value;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function is(string $key): bool
    {
        return $this->value === $key;
    }

    /**
     * @param string $value
     * @return bool
     */
    private function isValid(string $value): bool
    {
        return in_array($value, self::VALUES, true);
    }
}
