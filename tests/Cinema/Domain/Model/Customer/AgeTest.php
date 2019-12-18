<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Customer;

use Cinema\Domain\Model\Customer\Age;
use Cinema\Domain\Model\Exception\IncorrectValueException;
use DateInterval;
use DateTime;

class AgeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     */
    public function testInstantiateWithIncorrectValue(): void
    {
        $this->expectException(IncorrectValueException::class);

        new Age(-1);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testCreateFromBirthday(): void
    {
        $now = new DateTime();
        $now->sub(new DateInterval('P10Y'));

        $age = Age::createFromBirthday($now);

        $this->assertEquals(new Age(10), $age);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testCreateFromBirthdayOnFailure(): void
    {
        $this->expectException(IncorrectValueException::class);

        $now = new DateTime();
        $now->add(new DateInterval('P10Y'));

        Age::createFromBirthday($now);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testAgeOfSenior(): void
    {
        $this->assertTrue((new Age(Age::SENIOR_THRESHOLD))->isSenior());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testAgeOfNotSenior(): void
    {
        $this->assertFalse((new Age(Age::SENIOR_THRESHOLD - 1))->isSenior());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testAgeOfKids(): void
    {
        $this->assertTrue((new Age(Age::KIDS_AGE_FROM))->isKid());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testAgeOfNotKids(): void
    {
        $this->assertFalse((new Age(Age::KIDS_AGE_TO + 1))->isKid());
    }
}
