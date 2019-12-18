<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Plan\Specification;

use Cinema\Domain\Model\Plan\Specification\KidsSpecification;
use Tests\Cinema\FixtureTrait;

class KidsSpecificationTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     */
    public function testOrderIsSatisfiedByPlan(): void
    {
        $spec = new KidsSpecification();

        $order = $this->createOrder($this->createKidsCustomer());

        $this->assertTrue($spec->isSatisfiedBy($order));
    }

    /**
     * @return void
     */
    public function testOrderIsNotSatisfiedByPlan(): void
    {
        $spec = new KidsSpecification();

        $order = $this->createOrder($this->createSeniorCustomer());

        $this->assertFalse($spec->isSatisfiedBy($order));
    }
}
