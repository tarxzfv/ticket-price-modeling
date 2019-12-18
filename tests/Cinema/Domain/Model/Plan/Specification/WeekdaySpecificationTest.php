<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Plan\Specification;

use Cinema\Domain\Model\Plan\Specification\WeekdaySpecification;
use Tests\Cinema\FixtureTrait;

class WeekdaySpecificationTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     */
    public function testOrderIsSatisfiedByPlan(): void
    {
        $spec = new WeekdaySpecification();

        $order = $this->createOrder(
            null,
            $this->createShowtime(null, $this->createWeekdayDateTime())
        );

        $this->assertTrue($spec->isSatisfiedBy($order));
    }

    /**
     * @return void
     */
    public function testOrderIsNotSatisfiedByPlan(): void
    {
        $spec = new WeekdaySpecification();

        $order = $this->createOrder(
            null,
            $this->createShowtime(null, $this->createHolidayDateTime())
        );

        $this->assertFalse($spec->isSatisfiedBy($order));
    }
}
