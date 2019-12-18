<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Plan\Specification;

use Cinema\Domain\Shared\Specification\Specification;

class NonMembershipSpecification implements Specification
{
    /**
     * @param \Cinema\Domain\Model\Order $candidate
     * @return bool
     */
    public function isSatisfiedBy($candidate): bool
    {
        return !$candidate->customer()->isCinemaSitizen() &&
                !$candidate->customer()->isCinemaSitizenSenior();
    }
}
