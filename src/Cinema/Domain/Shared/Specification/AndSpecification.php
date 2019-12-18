<?php

declare(strict_types=1);

namespace Cinema\Domain\Shared\Specification;

class AndSpecification extends CompositeSpecification implements Specification
{
    /**
     * @param mixed $candidate
     * @return bool
     */
    public function isSatisfiedBy($candidate): bool
    {
        $isSatisfied = true;

        foreach ($this->specifications as $specification) {
            if (!$specification->isSatisfiedBy($candidate)) {
                $isSatisfied = false;
                break;
            }
        }

        return $isSatisfied;
    }
}
