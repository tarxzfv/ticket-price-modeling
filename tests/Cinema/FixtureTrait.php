<?php

declare(strict_types=1);

namespace Tests\Cinema;

use Cinema\Domain\Model\Customer\Age;
use Cinema\Domain\Model\Customer\Customer;
use Cinema\Domain\Model\Customer\Gender;
use Cinema\Domain\Model\Customer\Membership;
use Cinema\Domain\Model\Order;
use Cinema\Domain\Model\Plan\MembershipPlan;
use Cinema\Domain\Model\Plan\Plan;
use Cinema\Domain\Model\Plan\Price;
use Cinema\Domain\Model\Showtime\Schedule;
use Cinema\Domain\Model\Showtime\Showtime;
use Cinema\Domain\Shared\Specification\Specification;
use DateTime;
use DateTimeZone;

trait FixtureTrait
{
    /**
     * @var string
     */
    public static $weekday = '2019-12-02';

    /**
     * @var string
     */
    public static $holiday = '2019-12-01';

    /**
     * @return DateTime
     * @throws \Exception
     */
    protected function createWeekdayDatetime(): DateTime
    {
        return $this->createDateTimeUTC(static::$weekday);
    }

    /**
     * @return DateTime
     * @throws \Exception
     */
    protected function createHolidayDatetime(): DateTime
    {
        return $this->createDateTimeUTC(static::$holiday);
    }

    /**
     * @param string|null $datetime
     * @return DateTime
     * @throws \Exception
     */
    protected function createDateTimeUTC(string $datetime = null): DateTime
    {
        return new DateTime($datetime ?? 'now', new DateTimeZone('UTC'));
    }

    /**
     * @param int|null $price
     * @param Specification|null $spec
     * @return Plan
     */
    protected function createPlan(
        int $price = null,
        Specification $spec = null
    ): Plan {
        if ($spec === null) {
            $spec = $this->prophesize(Specification::class);
            $spec = $spec->reveal();
        }

        return new Plan("testing", new Price($price ?? 1000), $spec);
    }

    /**
     * @param int|null $price
     * @param Specification|null $spec
     * @return MembershipPlan
     */
    protected function createMembershipPlan(
        int $price = null,
        Specification $spec = null
    ): MembershipPlan {
        if ($spec === null) {
            $spec = $this->prophesize(Specification::class);
            $spec = $spec->reveal();
        }

        return new MembershipPlan("testing", new Price($price ?? 1000), $spec);
    }

    /**
     * @param Customer|null $customer
     * @param Showtime|null $showtime
     * @return Order
     * @throws \Exception
     */
    protected function createOrder(Customer $customer = null, Showtime $showtime = null): Order
    {
        if ($customer === null) {
            $customer = $this->createCustomer();
        }

        if ($showtime === null) {
            $showtime = $this->createShowtime();
        }

        return new Order($customer, $showtime);
    }

    /**
     * @param string|null $gender
     * @param int|null $age
     * @return Customer
     */
    protected function createCinemaCitizenCustomer(
        string $gender = null,
        int $age = null
    ): Customer {
        return $this->createCustomer(
            $gender,
            $age,
            Membership::CINEMA_CITIZEN
        );
    }

    /**
     * @param string|null $gender
     * @param int|null $age
     * @return Customer
     */
    protected function createCinemaCitizenSeniorCustomer(
        string $gender = null,
        int $age = null
    ): Customer {
        return $this->createCustomer(
            $gender,
            $age,
            Membership::CINEMA_CITIZEN_SENIOR
        );
    }

    /**
     * @param string|null $gender
     * @return Customer
     */
    protected function createKidsCustomer(string $gender = null): Customer
    {
        return $this->createCustomer($gender, Age::KIDS_AGE_FROM);
    }

    /**
     * @param string|null $gender
     * @return Customer
     */
    protected function createSeniorCustomer(string $gender = null): Customer
    {
        return $this->createCustomer($gender, Age::SENIOR_THRESHOLD);
    }

    /**
     * @param string|null $gender
     * @param int|null $age
     * @param string|null $membership
     * @return Customer
     */
    protected function createCustomer(
        string $gender = null,
        int $age = null,
        string $membership = null
    ): Customer {
        return new Customer(
            new Gender($gender ?? Gender::MALE),
            new Age($age ?? 20),
            ($membership !== null) ? new Membership($membership) : null
        );
    }

    /**
     * @param string $movie
     * @param DateTime $schedule
     * @return Showtime
     * @throws \Exception
     */
    protected function createShowtime(
        string $movie = null,
        DateTime $schedule = null
    ): Showtime {
        return new Showtime(
            $movie ?? "testing",
            $this->createSchedule($schedule)
        );
    }

    /**
     * @param DateTime|null $schedule
     * @return Schedule
     * @throws \Exception
     */
    protected function createSchedule(DateTime $schedule = null): Schedule
    {
        return new Schedule($schedule ?? $this->createDateTimeUTC());
    }
}
