<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model;

use Cinema\Domain\Model\Showtime\Schedule;
use Cinema\Domain\Model\Showtime\Showtime;
use Tests\Cinema\FixtureTrait;

class OrderTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     * @throws \Exception
     */
    public function testCustomer(): void
    {
        $customer = $this->createCustomer();

        $order = $this->createOrder($customer);

        $this->assertEquals($customer, $order->customer());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testShowtime(): void
    {
        $showtime = new Showtime(
            "testing",
            new Schedule($this->createDateTimeUTC())
        );

        $order = $this->createOrder(null, $showtime);

        $this->assertEquals($showtime, $order->showtime());
    }
}
