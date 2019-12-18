<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Customer;

use Cinema\Domain\Model\Customer\Gender;
use Cinema\Domain\Model\Exception\IncorrectValueException;

class GenderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     */
    public function testInstantiateWithIncorrectValue(): void
    {
        $this->expectException(IncorrectValueException::class);

        new Gender('incorrect value');
    }
}
