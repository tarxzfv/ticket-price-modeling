<?php

declare(strict_types=1);

namespace Cinema\Domain\Shared\Specification;

interface Specification
{
    /**
     * @param mixed $candidate
     * @return bool
     */
    public function isSatisfiedBy($candidate): bool;
}
