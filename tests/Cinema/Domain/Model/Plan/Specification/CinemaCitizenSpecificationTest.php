<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Plan\Specification;

use Cinema\Domain\Model\Plan\Specification\CinemaCitizenSpecification;
use Tests\Cinema\FixtureTrait;

class CinemaCitizenSpecificationTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     */
    public function testOrderIsSatisfiedByPlan(): void
    {
        $spec = new CinemaCitizenSpecification();

        $order = $this->createOrder($this->createCinemaCitizenCustomer());

        $this->assertTrue($spec->isSatisfiedBy($order));
    }

    /**
     * @return void
     */
    public function testOrderIsNotSatisfiedByPlan(): void
    {
        $spec = new CinemaCitizenSpecification();

        $order = $this->createOrder();

        $this->assertFalse($spec->isSatisfiedBy($order));
    }
}
