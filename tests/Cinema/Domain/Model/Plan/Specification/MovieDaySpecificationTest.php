<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Plan\Specification;

use Cinema\Domain\Model\Plan\Specification\MovieDaySpecification;
use Tests\Cinema\FixtureTrait;

class MovieDaySpecificationTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     */
    public function testOrderIsSatisfiedByPlan(): void
    {
        $spec = new MovieDaySpecification();

        $dt = $this->createDateTimeUTC('2019-12-01');

        $order = $this->createOrder(
            null,
            $this->createShowtime(null, $dt)
        );

        $this->assertTrue($spec->isSatisfiedBy($order));
    }

    /**
     * @return void
     */
    public function testOrderIsNotSatisfiedByPlan(): void
    {
        $spec = new MovieDaySpecification();

        $dt = $this->createDateTimeUTC('2019-12-02');

        $order = $this->createOrder(
            null,
            $this->createShowtime(null, $dt)
        );

        $this->assertFalse($spec->isSatisfiedBy($order));
    }
}
