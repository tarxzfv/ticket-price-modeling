<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Customer;

use Cinema\Domain\Model\Customer\Membership;
use Cinema\Domain\Model\Exception\IncorrectValueException;

class MembershipTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     */
    public function testInstantiateWithIncorrectValue(): void
    {
        $this->expectException(IncorrectValueException::class);

        new Membership('incorrect value');
    }

    /**
     * @return void
     */
    public function testMembershipIs(): void
    {
        $membership = new Membership(Membership::CINEMA_CITIZEN);

        $this->assertTrue($membership->is(Membership::CINEMA_CITIZEN));
    }

    /**
     * @return void
     */
    public function testMembershipIsNot(): void
    {
        $membership = new Membership(Membership::CINEMA_CITIZEN);

        $this->assertFalse($membership->is(Membership::CINEMA_CITIZEN_SENIOR));
    }
}
