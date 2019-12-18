<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Plan\Specification;

use Cinema\Domain\Model\Plan\Specification\SeniorSpecification;
use Tests\Cinema\FixtureTrait;

class SeniorSpecificationTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     */
    public function testOrderIsSatisfiedByPlan(): void
    {
        $spec = new SeniorSpecification();

        $order = $this->createOrder($this->createSeniorCustomer());

        $this->assertTrue($spec->isSatisfiedBy($order));
    }

    /**
     * @return void
     */
    public function testOrderIsNotSatisfiedByPlan(): void
    {
        $spec = new SeniorSpecification();

        $order = $this->createOrder($this->createCustomer());

        $this->assertFalse($spec->isSatisfiedBy($order));
    }
}
