<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Plan;

use Cinema\Domain\Model\Plan\PlanCollection;
use Cinema\Domain\Shared\Specification\Specification;
use Tests\Cinema\FixtureTrait;

class PlanCollectionTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     */
    public function testGetAll(): void
    {
        $plan = $this->createPlan();

        $collection = new PlanCollection($plan);

        $this->assertSame([$plan], $collection->all());
    }

    /**
     * @return void
     */
    public function testGetAllWithNullValue(): void
    {
        $collection = new PlanCollection(null);

        $this->assertSame([], $collection->all());
    }

    /**
     * @return void
     */
    public function testMergeCollection(): void
    {
        $plan1 = $this->createPlan(1000);
        $collection1 = new PlanCollection($plan1);

        $plan2 = $this->createPlan(2000);
        $collection2 = new PlanCollection($plan2);

        $actual = $collection1->merge($collection2);
        $expected = new PlanCollection($plan1, $plan2);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function testFindSatisfiablePlanByOrder(): void
    {
        $order = $this->createOrder();

        $spec1 = $this->prophesize(Specification::class);
        $spec1->isSatisfiedBy($order)->willReturn(false)->shouldBeCalled();

        $plan1 = $this->createPlan(1000, $spec1->reveal());

        $spec2 = $this->prophesize(Specification::class);
        $spec2->isSatisfiedBy($order)->willReturn(true)->shouldBeCalled();

        $plan2 = $this->createPlan(2000, $spec2->reveal());

        $collection = new PlanCollection($plan1, $plan2);

        $this->assertSame($plan2, $collection->findSatisfiablePlanByOrder($order));
    }

    /**
     * @return void
     */
    public function testFindSatisfiablePlanByOrderFailure(): void
    {
        $order = $this->createOrder();

        $spec = $this->prophesize(Specification::class);
        $spec->isSatisfiedBy($order)->willReturn(false)->shouldBeCalled();

        $plan = $this->createPlan(1000, $spec->reveal());

        $collection = new PlanCollection($plan);

        $this->assertNull($collection->findSatisfiablePlanByOrder($order));
    }

    /**
     * @return void
     */
    public function testSortByPriceFromLowToHigh(): void
    {
        $plan1 = $this->createPlan(2000);
        $plan2 = $this->createPlan(1000);
        $plan3 = $this->createPlan(3000);

        $collection = new PlanCollection($plan1, $plan2, $plan3);

        $actual = $collection->sortByPriceFromLowToHigh();
        $expected = new PlanCollection($plan2, $plan1, $plan3);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function testSortByPriceFromLowToHighOnNull(): void
    {
        $collection = new PlanCollection(null);

        $actual = $collection->sortByPriceFromLowToHigh();
        $expected = $collection;

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function testSortByPriceFromHighToLow(): void
    {
        $plan1 = $this->createPlan(2000);
        $plan2 = $this->createPlan(1000);
        $plan3 = $this->createPlan(3000);

        $collection = new PlanCollection($plan1, $plan2, $plan3);

        $actual = $collection->sortByPriceFromHighToLow();
        $expected = new PlanCollection($plan3, $plan1, $plan2);

        $this->assertEquals($expected, $actual);
    }
}
