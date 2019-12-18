<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Plan;

use Cinema\Domain\Model\Plan\MembershipPlan;
use Cinema\Domain\Model\Plan\Price;
use Cinema\Domain\Shared\Specification\Specification;

class MembershipPlanTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     */
    public function testPlanIsNotMembershipPlan(): void
    {
        $spec = $this->prophesize(Specification::class);

        $plan = new MembershipPlan("testing", new Price(1000), $spec->reveal());

        $this->assertTrue($plan->isMembershipPlan());
    }
}
