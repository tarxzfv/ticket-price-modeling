<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Plan;

class MembershipPlan extends Plan
{
    /**
     * @return bool
     */
    public function isMembershipPlan(): bool
    {
        return true;
    }
}
