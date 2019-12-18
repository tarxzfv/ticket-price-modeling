<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Shared\Specification;

use Cinema\Domain\Shared\Specification\AndSpecification;
use Cinema\Domain\Shared\Specification\Specification;
use Prophecy\Argument;
use stdClass;

class AndSpecificationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     */
    public function testMockIsSatisfiedBySpec(): void
    {
        $spec1 = $this->prophesize(Specification::class);
        $spec1->isSatisfiedBy(Argument::any())->willReturn(true)->shouldBeCalled();

        $spec2 = $this->prophesize(Specification::class);
        $spec2->isSatisfiedBy(Argument::any())->willReturn(true)->shouldBeCalled();

        $andSpec = new AndSpecification($spec1->reveal(), $spec2->reveal());

        $this->assertTrue($andSpec->isSatisfiedBy(new stdClass()));
    }

    /**
     * @return void
     */
    public function testMockIsNotSatisfiedBySpec(): void
    {
        $spec1 = $this->prophesize(Specification::class);
        $spec1->isSatisfiedBy(Argument::any())->willReturn(true)->shouldBeCalled();

        $spec2 = $this->prophesize(Specification::class);
        $spec2->isSatisfiedBy(Argument::any())->willReturn(false)->shouldBeCalled();

        $andSpec = new AndSpecification($spec1->reveal(), $spec2->reveal());

        $this->assertFalse($andSpec->isSatisfiedBy(new stdClass()));
    }
}
