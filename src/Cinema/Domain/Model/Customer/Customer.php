<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Customer;

class Customer
{
    /**
     * @var Gender
     */
    private $gender;

    /**
     * @var Age
     */
    private $age;

    /**
     * @var Membership|null
     */
    private $membership;

    /**
     * @param Gender $gender
     * @param Age $age
     * @param Membership|null $membership
     */
    public function __construct(Gender $gender, Age $age, ?Membership $membership)
    {
        $this->gender = $gender;
        $this->age = $age;
        $this->membership = $membership;
    }

    /**
     * @return bool
     */
    public function isSenior(): bool
    {
        return $this->age->isSenior();
    }

    /**
     * @return bool
     */
    public function isKid(): bool
    {
        return $this->age->isKid();
    }

    /**
     * @return bool
     */
    public function isCinemaSitizen(): bool
    {
        return $this->membership !== null &&
                $this->membership->is(Membership::CINEMA_CITIZEN);
    }

    /**
     * @return bool
     */
    public function isCinemaSitizenSenior(): bool
    {
        return $this->membership !== null &&
                $this->membership->is(Membership::CINEMA_CITIZEN_SENIOR);
    }
}
