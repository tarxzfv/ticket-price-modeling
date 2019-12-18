<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Plan;

use Cinema\Domain\Model\Exception\IncorrectValueException;

class Price
{
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
     * @param int $value
     * @return bool
     */
    private function isValid(int $value): bool
    {
        return 0 <= $value;
    }
}
