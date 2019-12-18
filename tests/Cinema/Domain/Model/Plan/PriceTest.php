<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Plan;

use Cinema\Domain\Model\Plan\Price;
use Cinema\Domain\Model\Exception\IncorrectValueException;

class PriceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     */
    public function testInstantiateWithIncorrectValue(): void
    {
        $this->expectException(IncorrectValueException::class);

        new Price(-1);
    }

    /**
     * @return void
     */
    public function testInstantiateWithZeroValue(): void
    {
        $price = new Price(0);

        $this->assertEquals(new Price(0), $price);
    }
}
