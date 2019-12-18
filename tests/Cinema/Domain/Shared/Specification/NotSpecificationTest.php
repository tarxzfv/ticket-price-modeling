<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Shared\Specification;

use Cinema\Domain\Shared\Specification\NotSpecification;
use Cinema\Domain\Shared\Specification\Specification;
use Prophecy\Argument;
use stdClass;

class NotSpecificationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     */
    public function testMockIsSatisfiedBySpec(): void
    {
        $spec = $this->prophesize(Specification::class);
        $spec->isSatisfiedBy(Argument::any())->willReturn(false)->shouldBeCalled();

        $NotSpec = new NotSpecification($spec->reveal());

        $this->assertTrue($NotSpec->isSatisfiedBy(new stdClass()));
    }

    /**
     * @return void
     */
    public function testMockIsNotSatisfiedBySpec(): void
    {
        $spec = $this->prophesize(Specification::class);
        $spec->isSatisfiedBy(Argument::any())->willReturn(true)->shouldBeCalled();

        $NotSpec = new NotSpecification($spec->reveal());

        $this->assertFalse($NotSpec->isSatisfiedBy(new stdClass()));
    }
}
