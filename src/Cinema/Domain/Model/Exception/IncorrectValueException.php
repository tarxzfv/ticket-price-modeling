<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Exception;

class IncorrectValueException extends \InvalidArgumentException implements DomainException
{
    // ...
}
