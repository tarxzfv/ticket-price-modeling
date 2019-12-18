<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Plan\Specification;

use Cinema\Domain\Model\Plan\Specification\HolidaySpecification;
use Tests\Cinema\FixtureTrait;

class HolidaySpecificationTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     */
    public function testOrderIsSatisfiedByPlan(): void
    {
        $spec = new HolidaySpecification();

        $order = $this->createOrder(
            null,
            $this->createShowtime(null, $this->createHolidayDateTime())
        );

        $this->assertTrue($spec->isSatisfiedBy($order));
    }

    /**
     * @return void
     */
    public function testOrderIsNotSatisfiedByPlan(): void
    {
        $spec = new HolidaySpecification();

        $order = $this->createOrder(
            null,
            $this->createShowtime(null, $this->createWeekdayDateTime())
        );

        $this->assertFalse($spec->isSatisfiedBy($order));
    }
}
