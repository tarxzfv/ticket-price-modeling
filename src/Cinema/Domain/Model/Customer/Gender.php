<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Customer;

use Cinema\Domain\Model\Exception\IncorrectValueException;

class Gender
{
    /**
     * @var string
     */
    public const MALE = 'mail';

    /**
     * @var string
     */
    public const FEMALE = 'femail';

    /**
     * @var string[]
     */
    private const VALUES = [
        self::MALE,
        self::FEMALE,
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
     * @param string $value
     * @return bool
     */
    private function isValid(string $value): bool
    {
        return in_array($value, self::VALUES, true);
    }
}
