<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Plan\Specification;

use Cinema\Domain\Model\Plan\Specification\CinemaCitizenSeniorSpecification;
use Tests\Cinema\FixtureTrait;

class CinemaCitizenSeniorSpecificationTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     */
    public function testOrderIsSatisfiedByPlan(): void
    {
        $spec = new CinemaCitizenSeniorSpecification();

        $order = $this->createOrder($this->createCinemaCitizenSeniorCustomer());

        $this->assertTrue($spec->isSatisfiedBy($order));
    }

    /**
     * @return void
     */
    public function testOrderIsNotSatisfiedByPlan(): void
    {
        $spec = new CinemaCitizenSeniorSpecification();

        $order = $this->createOrder();

        $this->assertFalse($spec->isSatisfiedBy($order));
    }
}
