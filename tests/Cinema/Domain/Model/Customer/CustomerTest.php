<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Customer;

use Cinema\Domain\Model\Customer\Age;
use Cinema\Domain\Model\Customer\Membership;
use Tests\Cinema\FixtureTrait;

class CustomerTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     */
    public function testCustomerIsKid(): void
    {
        $customer = $this->createCustomer(null, Age::KIDS_AGE_FROM);

        $this->assertTrue($customer->isKid());
    }

    /**
     * @return void
     */
    public function testCustomerIsSenior(): void
    {
        $customer = $this->createCustomer(null, Age::SENIOR_THRESHOLD);

        $this->assertTrue($customer->isSenior());
    }

    /**
     * @return void
     */
    public function testCustomerIsCinemaCitizen(): void
    {
        $customer = $this->createCustomer(
            null,
            null,
            Membership::CINEMA_CITIZEN
        );

        $this->assertTrue($customer->isCinemaSitizen());
    }

    /**
     * @return void
     */
    public function testCustomerIsNotCinemaCitizen(): void
    {
        $customer = $this->createCustomer(null, null, null);

        $this->assertFalse($customer->isCinemaSitizen());
    }

    /**
     * @return void
     */
    public function testCustomerIsCinemaCitizenSenior(): void
    {
        $customer = $this->createCustomer(
            null,
            null,
            Membership::CINEMA_CITIZEN_SENIOR
        );

        $this->assertTrue($customer->isCinemaSitizenSenior());
    }

    /**
     * @return void
     */
    public function testCustomerIsNotCinemaCitizenSenior(): void
    {
        $customer = $this->createCustomer(null, null, null);

        $this->assertFalse($customer->isCinemaSitizenSenior());
    }
}
