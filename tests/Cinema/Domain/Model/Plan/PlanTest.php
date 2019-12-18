<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Plan;

use Cinema\Domain\Model\Plan\Price;
use Cinema\Domain\Shared\Specification\Specification;
use Tests\Cinema\FixtureTrait;

class PlanTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     */
    public function testGetPrice(): void
    {
        $plan = $this->createPlan(1000);

        $this->assertEquals(new Price(1000), $plan->price());
    }

    /**
     * @return void
     */
    public function testOrderIsSatisfiedByPlan(): void
    {
        $order = $this->createOrder();

        $spec = $this->prophesize(Specification::class);
        $spec->isSatisfiedBy($order)->willReturn(true)->shouldBeCalled();

        $plan = $this->createPlan(1000, $spec->reveal());

        $this->assertTrue($plan->isSatisfiedBy($order));
    }

    /**
     * @return void
     */
    public function testPlanIsNotMembershipPlan(): void
    {
        $this->assertFalse($this->createPlan()->isMembershipPlan());
    }
}
