<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Plan\Specification;

use Cinema\Domain\Model\Plan\Specification\LateShowSpecification;
use Tests\Cinema\FixtureTrait;

class LateShowSpecificationTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     */
    public function testOrderIsSatisfiedByPlan(): void
    {
        $spec = new LateShowSpecification();

        $dt = $this->createDateTimeUTC(self::$weekday . ' 20:00:00');

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
        $spec = new LateShowSpecification();

        $dt = $this->createDateTimeUTC(self::$weekday . ' 19:59:59');

        $order = $this->createOrder(
            null,
            $this->createShowtime(null, $dt)
        );

        $this->assertFalse($spec->isSatisfiedBy($order));
    }
}
