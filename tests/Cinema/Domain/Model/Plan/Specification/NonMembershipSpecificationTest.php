<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Plan\Specification;

use Cinema\Domain\Model\Plan\Specification\NonMembershipSpecification;
use Tests\Cinema\FixtureTrait;

class NonMembershipSpecificationTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     */
    public function testOrderIsSatisfiedByPlan(): void
    {
        $spec = new NonMembershipSpecification();

        $order = $this->createOrder($this->createCustomer());

        $this->assertTrue($spec->isSatisfiedBy($order));
    }

    /**
     * @return void
     */
    public function testOrderIsNotSatisfiedByPlan(): void
    {
        $spec = new NonMembershipSpecification();

        $order = $this->createOrder($this->createCinemaCitizenCustomer());

        $this->assertFalse($spec->isSatisfiedBy($order));
    }
}
